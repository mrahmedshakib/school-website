<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionPayment;
use App\Services\SmsService;
use App\Mail\AdmissionApprovedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdmissionPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = AdmissionPayment::with('application');


        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'payment_no',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'transaction_id',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'application',
                    function ($applicationQuery) use ($search) {

                        $applicationQuery
                            ->where(
                                'application_no',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'student_name',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'guardian_phone',
                                'like',
                                "%{$search}%"
                            );
                    }
                );

            });
        }


        $payments = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        $total = AdmissionPayment::count();

        $pending = AdmissionPayment::where(
            'status',
            'pending'
        )->count();

        $approved = AdmissionPayment::where(
            'status',
            'approved'
        )->count();

        $rejected = AdmissionPayment::where(
            'status',
            'rejected'
        )->count();


        return view(
            'backend.admission-payments.index',
            compact(
                'payments',
                'total',
                'pending',
                'approved',
                'rejected'
            )
        );
    }


    public function show(
        AdmissionPayment $admissionPayment
    ) {
        $admissionPayment->load('application');

        return view(
            'backend.admission-payments.show',
            compact('admissionPayment')
        );
    }


    public function updateStatus(
        Request $request,
        AdmissionPayment $admissionPayment
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],

            'admin_note' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);


        $admissionPayment->load('application');

        $oldStatus =
            $admissionPayment->status;

        $newStatus =
            $validated['status'];


        /*
        |--------------------------------------------------------------------------
        | Update Payment
        |--------------------------------------------------------------------------
        */

        $admissionPayment->status =
            $newStatus;

        $admissionPayment->admin_note =
            $validated['admin_note'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | Payment Approved
        |--------------------------------------------------------------------------
        */

        if ($newStatus === 'approved') {

            $admissionPayment->verified_at =
                now();


            /*
            |--------------------------------------------------------------------------
            | Confirm Application
            |--------------------------------------------------------------------------
            */

            $admissionPayment
                ->application
                ->update([
                    'status' => 'approved',
                ]);


            /*
            |--------------------------------------------------------------------------
            | Send Approval Email
            |--------------------------------------------------------------------------
            */

            $application =
                $admissionPayment->application;


            if ($application->email) {

                try {

                    Mail::to($application->email)
                        ->send(
                            new AdmissionApprovedMail(
                                $admissionPayment
                            )
                        );

                } catch (\Throwable $e) {

                    \Log::error(
                        'Admission approval email failed',
                        [
                            'application_no' =>
                                $application->application_no,

                            'payment_no' =>
                                $admissionPayment->payment_no,

                            'error' =>
                                $e->getMessage(),
                        ]
                    );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Send Approval SMS
            |--------------------------------------------------------------------------
            */

            $smsMessage =
                "Admission confirmed. " .
                "Application No: {$application->application_no}. " .
                "Student: {$application->student_name}. " .
                "Payment verified successfully. Thank you.";

            app(SmsService::class)->send(
                $application->guardian_phone,
                $smsMessage
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Payment Rejected
        |--------------------------------------------------------------------------
        */

        elseif ($newStatus === 'rejected') {

            $admissionPayment->verified_at =
                null;


            /*
            |--------------------------------------------------------------------------
            | Application Goes Back to Payment Pending
            |--------------------------------------------------------------------------
            */

            $admissionPayment
                ->application
                ->update([
                    'status' => 'payment_pending',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Pending
        |--------------------------------------------------------------------------
        */

        else {

            $admissionPayment->verified_at =
                null;

            $admissionPayment
                ->application
                ->update([
                    'status' => 'payment_pending',
                ]);
        }


        $admissionPayment->save();


        return redirect()
            ->route(
                'admin.admission-payments.show',
                $admissionPayment
            )
            ->with(
                'success',
                'Payment status updated successfully.'
            );
    }


    public function destroy(
        AdmissionPayment $admissionPayment
    ) {

        if ($admissionPayment->payment_proof) {

            $path = str_replace(
                'storage/',
                '',
                $admissionPayment->payment_proof
            );

            if (
                Storage::disk('public')
                    ->exists($path)
            ) {

                Storage::disk('public')
                    ->delete($path);
            }
        }


        $admissionPayment->delete();


        return redirect()
            ->route(
                'admin.admission-payments.index'
            )
            ->with(
                'success',
                'Payment deleted successfully.'
            );
    }
}