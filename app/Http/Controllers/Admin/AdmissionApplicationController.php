<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionApplication;
use App\Services\SmsService;
use App\Mail\AdmissionApprovedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdmissionApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionApplication::with('payments');

        // Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            if ($request->status === 'confirmed') {
                $query->where('is_confirmed', 1);
            } else {
                $query->where('status', $request->status);
            }
        }

        // Class Filter
        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        // Academic Year Filter
        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('application_no', 'like', "%{$search}%")
                    ->orWhere('student_name', 'like', "%{$search}%")
                    ->orWhere('student_name_bn', 'like', "%{$search}%")
                    ->orWhere('student_name_en', 'like', "%{$search}%")
                    ->orWhere('guardian_phone', 'like', "%{$search}%")
                    ->orWhere('birth_reg_no', 'like', "%{$search}%");
            });
        }

        $applications = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        // Statistics
        $total = AdmissionApplication::count();
        $pending = AdmissionApplication::where('status', 'pending')->count();
        $paymentPending = AdmissionApplication::where('status', 'payment_pending')->count();
        $selectedLottery = AdmissionApplication::where('status', 'selected_lottery')->count();
        $approved = AdmissionApplication::where('status', 'approved')->count();
        $rejected = AdmissionApplication::where('status', 'rejected')->count();
        $confirmed = AdmissionApplication::where('is_confirmed', 1)->count();

        // Distinct filters
        $classes = AdmissionApplication::whereNotNull('class')->distinct()->pluck('class');
        $academicYears = AdmissionApplication::whereNotNull('academic_year')->distinct()->pluck('academic_year');

        return view(
            'backend.admission-applications.index',
            compact(
                'applications',
                'total',
                'pending',
                'paymentPending',
                'selectedLottery',
                'approved',
                'rejected',
                'confirmed',
                'classes',
                'academicYears'
            )
        );
    }

    public function show(AdmissionApplication $admissionApplication)
    {
        $admissionApplication->load('payments');

        return view(
            'backend.admission-applications.show',
            compact('admissionApplication')
        );
    }

    public function updateStatus(
        Request $request,
        AdmissionApplication $admissionApplication
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,payment_pending,selected_lottery,approved,rejected'
            ],
            'admin_note' => [
                'nullable',
                'string',
                'max:5000'
            ],
            'confirm_admission' => [
                'nullable',
                'boolean'
            ],
        ]);

        $updateData = [
            'status' => $validated['status'],
            'admin_note' => $validated['admin_note'] ?? null,
        ];

        if ($request->boolean('confirm_admission') || $validated['status'] === 'approved') {
            $updateData['is_confirmed'] = 1;
            $updateData['confirmed_at'] = now();
        }

        $admissionApplication->update($updateData);

        // Notify if approved/confirmed
        if ($validated['status'] === 'approved') {
            $this->notifyConfirmation($admissionApplication);
        }

        return redirect()
            ->route('admin.admission-applications.show', $admissionApplication)
            ->with('success', 'আবেদনের স্ট্যাটাস সফলভাবে আপডেট করা হয়েছে।');
    }

    public function destroy(AdmissionApplication $admissionApplication)
    {
        $admissionApplication->delete();

        return redirect()
            ->route('admin.admission-applications.index')
            ->with('success', 'আবেদনটি মুছে ফেলা হয়েছে।');
    }

    /*
    |--------------------------------------------------------------------------
    | Digital Lottery Control Panel
    |--------------------------------------------------------------------------
    */
    public function lotteryIndex(Request $request)
    {
        $academicYear = $request->input('academic_year', date('Y'));
        $classes = AdmissionApplication::whereNotNull('class')->distinct()->pluck('class');
        $selectedClass = $request->input('class', $classes->first() ?? '৬ষ্ঠ শ্রেণি (Class Six)');

        // Eligible candidates query (candidates in this academic year and class who are not rejected)
        $candidatesQuery = AdmissionApplication::where('academic_year', $academicYear)
            ->where('class', $selectedClass)
            ->where('status', '!=', 'rejected');

        $totalApplicants = (clone $candidatesQuery)->count();
        $paidApplicants = (clone $candidatesQuery)->whereHas('payments', function ($q) {
            $q->where('status', 'approved');
        })->count();

        // Selected candidates (Merit List)
        $selectedCandidates = (clone $candidatesQuery)
            ->where('is_lottery_selected', 1)
            ->orderBy('lottery_rank')
            ->get();

        // Waiting candidates
        $waitingCandidates = (clone $candidatesQuery)
            ->where('lottery_quota', 'waiting')
            ->orderBy('lottery_rank')
            ->get();

        $isDrawn = $selectedCandidates->isNotEmpty();

        return view('backend.admission-lottery.index', compact(
            'academicYear',
            'classes',
            'selectedClass',
            'totalApplicants',
            'paidApplicants',
            'selectedCandidates',
            'waitingCandidates',
            'isDrawn'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Run Digital Lottery Draw
    |--------------------------------------------------------------------------
    */
    public function lotteryDraw(Request $request)
    {
        $validated = $request->validate([
            'academic_year' => 'required|string',
            'class' => 'required|string',
            'seats' => 'required|integer|min:1',
            'quota_ff' => 'nullable|numeric|min:0|max:100', // Freedom Fighter %
            'quota_sibling' => 'nullable|numeric|min:0|max:100', // Sibling/Staff %
            'quota_catchment' => 'nullable|numeric|min:0|max:100', // Catchment %
            'only_paid' => 'nullable|boolean',
        ]);

        $academicYear = $validated['academic_year'];
        $class = $validated['class'];
        $seats = (int)$validated['seats'];

        $query = AdmissionApplication::where('academic_year', $academicYear)
            ->where('class', $class)
            ->where('status', '!=', 'rejected');

        if ($request->boolean('only_paid')) {
            $query->whereHas('payments', function ($q) {
                $q->where('status', 'approved');
            });
        }

        $candidates = $query->get();

        if ($candidates->isEmpty()) {
            return redirect()->back()->with('error', 'এই শ্রেণি এবং শিক্ষাবর্ষের জন্য কোনো যোগ্য আবেদনকারী পাওয়া যায়নি।');
        }

        // Cryptographically-secure random shuffle
        $shuffled = $candidates->shuffle();

        $ffPercent = (float)($validated['quota_ff'] ?? 5);
        $siblingPercent = (float)($validated['quota_sibling'] ?? 5);
        $catchmentPercent = (float)($validated['quota_catchment'] ?? 10);

        $ffSeats = (int)round(($seats * $ffPercent) / 100);
        $siblingSeats = (int)round(($seats * $siblingPercent) / 100);
        $catchmentSeats = (int)round(($seats * $catchmentPercent) / 100);
        $generalSeats = max(0, $seats - ($ffSeats + $siblingSeats + $catchmentSeats));

        $rank = 1;
        $now = now();

        foreach ($shuffled as $index => $candidate) {
            if ($rank <= $seats) {
                // Determine Quota Tag
                if ($rank <= $generalSeats) {
                    $quota = 'general';
                } elseif ($rank <= $generalSeats + $ffSeats) {
                    $quota = 'freedom_fighter';
                } elseif ($rank <= $generalSeats + $ffSeats + $siblingSeats) {
                    $quota = 'sibling';
                } else {
                    $quota = 'catchment';
                }

                $candidate->update([
                    'is_lottery_selected' => 1,
                    'lottery_rank' => $rank,
                    'lottery_quota' => $quota,
                    'lottery_drawn_at' => $now,
                    'status' => 'selected_lottery',
                ]);
            } else {
                // Waiting list candidate
                $candidate->update([
                    'is_lottery_selected' => 0,
                    'lottery_rank' => $rank,
                    'lottery_quota' => 'waiting',
                    'lottery_drawn_at' => $now,
                ]);
            }

            $rank++;
        }

        $selectedCount = min($seats, $candidates->count());
        $waitingCount = max(0, $candidates->count() - $seats);

        return redirect()->back()->with(
            'success',
            "ডিজিটাল লটারি সফলভাবে সম্পন্ন হয়েছে! মোট {$selectedCount} জন মেধা তালিকায় এবং {$waitingCount} জন অপেক্ষমাণ তালিকায় স্থান পেয়েছে।"
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Reset Lottery for Class / Academic Year
    |--------------------------------------------------------------------------
    */
    public function lotteryReset(Request $request)
    {
        $validated = $request->validate([
            'academic_year' => 'required|string',
            'class' => 'required|string',
        ]);

        AdmissionApplication::where('academic_year', $validated['academic_year'])
            ->where('class', $validated['class'])
            ->update([
                'is_lottery_selected' => 0,
                'lottery_rank' => null,
                'lottery_quota' => null,
                'lottery_drawn_at' => null,
                'status' => 'pending',
            ]);

        return redirect()->back()->with('success', 'লটারি ফলাফল সফলভাবে রিসেট করা হয়েছে।');
    }

    /*
    |--------------------------------------------------------------------------
    | One-Click Final Admission Confirmation
    |--------------------------------------------------------------------------
    */
    public function lotteryConfirm(Request $request, AdmissionApplication $admissionApplication)
    {
        $admissionApplication->update([
            'is_confirmed' => 1,
            'confirmed_at' => now(),
            'status' => 'approved',
        ]);

        $this->notifyConfirmation($admissionApplication);

        return redirect()->back()->with(
            'success',
            "শিক্ষার্থী {$admissionApplication->student_name}-এর ভর্তি সফলভাবে নিশ্চিত করা হয়েছে।"
        );
    }

    /**
     * Send notification SMS and Email upon admission confirmation
     */
    protected function notifyConfirmation(AdmissionApplication $application)
    {
        // SMS Notification
        try {
            $smsMsg = "BIAM School: Congratulations! Admission confirmed for {$application->student_name}, Class: {$application->class}, App No: {$application->application_no}.";
            app(SmsService::class)->send($application->guardian_phone, $smsMsg);
        } catch (\Throwable $e) {
            Log::error('Admission confirmation SMS failed', ['error' => $e->getMessage()]);
        }

        // Email Notification
        if ($application->email) {
            try {
                Mail::to($application->email)->send(new AdmissionApprovedMail($application));
            } catch (\Throwable $e) {
                Log::error('Admission confirmation Email failed', ['error' => $e->getMessage()]);
            }
        }
    }
}