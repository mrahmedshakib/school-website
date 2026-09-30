<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\SmsService;
use App\Models\Notice;
use App\Models\Slider;
use App\Models\WebsiteSetting;
use App\Models\Administration;
use App\Models\About;
use App\Models\MissionVision;
use App\Models\Teacher;
use App\Models\Gallery;
use App\Models\Admission;
use App\Models\AdmissionApplication;
use App\Models\AdmissionPayment;
use App\Models\AdmissionFee;
use App\Models\AcademicSyllabus;
use App\Models\ClassRoutine;
use App\Models\ExamRoutine;
use App\Models\AcademicSubject;
use App\Models\ExamResult;
use App\Models\StudentMark;
use App\Models\Student;
use App\Models\SchoolPublication;
use App\Models\VideoGallery;
use Illuminate\Support\Facades\DB;
use App\Mail\AdmissionApplicationSubmittedMail;
use App\Mail\AdmissionPaymentSubmittedMail;
use App\Mail\AdmissionApprovedMail;
use App\Services\SslCommerzService;

class FrontendController extends Controller
{
    public function home()
    {
        $websiteSetting = WebsiteSetting::first();

        $notices = Notice::where('status', 1)
            ->where('is_delete', 0)
            ->orderByDesc('notice_date')
            ->orderByDesc('id')
            ->take(6)
            ->get();

        $administrations = Administration::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(6)
            ->get();

        $about = About::where('status', 1)
            ->where('is_delete', 0)
            ->latest()
            ->first();

        $sliders = Slider::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $missionVision = MissionVision::where('status', 1)
            ->where('is_delete', 0)
            ->latest()
            ->first();

        $teachers = Teacher::where('type', 'teacher')
            ->where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(8)
            ->get();

        $staff = Teacher::where('type', 'staff')
            ->where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->take(8)
            ->get();

        $galleries = Gallery::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->take(8)
            ->get();

        $admissions = Admission::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->take(1)
            ->get();

        return view(
            'frontend.home',
            compact(
                'websiteSetting',
                'notices',
                'administrations',
                'about',
                'sliders',
                'missionVision',
                'teachers',
                'staff',
                'galleries',
                'admissions'
            )
        );
    }

    public function about()
    {
        $websiteSetting = WebsiteSetting::first();

        $about = About::where('status', 1)
            ->where('is_delete', 0)
            ->latest()
            ->first();

        return view(
            'frontend.about',
            compact('websiteSetting', 'about')
        );
    }

    public function missionVision()
    {
        $websiteSetting = WebsiteSetting::first();

        $missionVision = MissionVision::where('status', 1)
            ->where('is_delete', 0)
            ->latest()
            ->first();

        return view(
            'frontend.mission-vision',
            compact('websiteSetting', 'missionVision')
        );
    }

    public function leadership()
    {
        $websiteSetting = WebsiteSetting::first();

        $administrations = Administration::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'frontend.leadership',
            compact('websiteSetting', 'administrations')
        );
    }

    public function administration()
    {
        $websiteSetting = WebsiteSetting::first();

        $administrations = Administration::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'frontend.administration',
            compact('websiteSetting', 'administrations')
        );
    }

    public function notice(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = Notice::where('status', 1)
            ->where('is_delete', 0);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('title_bn', 'like', "%{$term}%")
                    ->orWhere('title_en', 'like', "%{$term}%")
                    ->orWhere('description_bn', 'like', "%{$term}%")
                    ->orWhere('description_en', 'like', "%{$term}%");
            });
        }

        $notices = $query->orderByDesc('notice_date')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $categories = Notice::where('status', 1)
            ->where('is_delete', 0)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view(
            'frontend.notice',
            compact('websiteSetting', 'notices', 'categories')
        );
    }

    public function syllabus(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = AcademicSyllabus::where('status', 1)
            ->orderBy('sort_order')
            ->latest('id');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('title_bn', 'like', "%{$term}%")
                    ->orWhere('title_en', 'like', "%{$term}%")
                    ->orWhere('subject_name_bn', 'like', "%{$term}%")
                    ->orWhere('subject_name_en', 'like', "%{$term}%");
            });
        }

        $syllabuses = $query->paginate(12)->withQueryString();

        $classes = AcademicSyllabus::where('status', 1)->distinct()->pluck('class');
        $years = AcademicSyllabus::where('status', 1)->distinct()->pluck('academic_year');

        return view(
            'frontend.syllabus',
            compact('websiteSetting', 'syllabuses', 'classes', 'years')
        );
    }

    public function classRoutine(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = ClassRoutine::where('status', 1)
            ->orderBy('sort_order')
            ->latest('id');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        if ($request->filled('shift')) {
            $query->where('shift', $request->shift);
        }

        $routines = $query->paginate(12)->withQueryString();

        $classes = ClassRoutine::where('status', 1)->distinct()->pluck('class');
        $sections = ClassRoutine::where('status', 1)->whereNotNull('section')->distinct()->pluck('section');

        return view(
            'frontend.class-routine',
            compact('websiteSetting', 'routines', 'classes', 'sections')
        );
    }

    public function examRoutine(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = ExamRoutine::where('status', 1)
            ->orderBy('sort_order')
            ->latest('start_date');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        $examRoutines = $query->paginate(12)->withQueryString();

        $classes = ExamRoutine::where('status', 1)->distinct()->pluck('class');
        $years = ExamRoutine::where('status', 1)->distinct()->pluck('academic_year');

        return view(
            'frontend.exam-routine',
            compact('websiteSetting', 'examRoutines', 'classes', 'years')
        );
    }

    public function subjects(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = AcademicSubject::where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('code');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('group_name')) {
            $query->where('group_name', $request->group_name);
        }

        $subjects = $query->get()->groupBy('class');

        $classes = AcademicSubject::where('status', 1)->distinct()->pluck('class');
        $groups = AcademicSubject::where('status', 1)->whereNotNull('group_name')->distinct()->pluck('group_name');

        return view(
            'frontend.subjects',
            compact('websiteSetting', 'subjects', 'classes', 'groups')
        );
    }

    public function results(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = ExamResult::where('status', 1)
            ->orderBy('sort_order')
            ->latest('publish_date');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        $results = $query->paginate(12)->withQueryString();

        $classes = ExamResult::where('status', 1)->distinct()->pluck('class');
        $years = ExamResult::where('status', 1)->distinct()->pluck('academic_year');

        return view(
            'frontend.results',
            compact('websiteSetting', 'results', 'classes', 'years')
        );
    }

    public function result(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $searched = false;
        $studentMark = null;

        if ($request->filled('roll_no') && $request->filled('class')) {
            $searched = true;
            $query = StudentMark::where('roll_no', $request->roll_no)
                ->where('class', $request->class);

            if ($request->filled('academic_year')) {
                $query->where('academic_year', $request->academic_year);
            }

            if ($request->filled('exam_name')) {
                $exam = $request->exam_name;
                $query->where(function($q) use ($exam) {
                    $q->where('exam_name_bn', $exam)
                      ->orWhere('exam_name_en', $exam);
                });
            }

            $studentMark = $query->first();
        }

        $classes = StudentMark::distinct()->pluck('class');
        $examNames = StudentMark::select('exam_name_bn', 'exam_name_en')->get()->map(function($item) {
            return $item->exam_name;
        })->filter()->unique();
        $years = StudentMark::distinct()->pluck('academic_year');

        return view(
            'frontend.result',
            compact('websiteSetting', 'searched', 'studentMark', 'classes', 'examNames', 'years')
        );
    }

    public function teachers(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = Teacher::where('status', 1)
            ->where('is_delete', 0)
            ->where('type', 'teacher');

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('name_bn', 'like', "%{$term}%")
                    ->orWhere('name_en', 'like', "%{$term}%")
                    ->orWhere('designation', 'like', "%{$term}%")
                    ->orWhere('designation_bn', 'like', "%{$term}%")
                    ->orWhere('designation_en', 'like', "%{$term}%")
                    ->orWhere('subject', 'like', "%{$term}%")
                    ->orWhere('subject_bn', 'like', "%{$term}%")
                    ->orWhere('subject_en', 'like', "%{$term}%");
            });
        }

        $teachers = $query->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return view(
            'frontend.teachers',
            compact('websiteSetting', 'teachers')
        );
    }

    public function staff(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = Teacher::where('status', 1)
            ->where('is_delete', 0)
            ->where('type', 'staff');

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('name_bn', 'like', "%{$term}%")
                    ->orWhere('name_en', 'like', "%{$term}%")
                    ->orWhere('designation', 'like', "%{$term}%")
                    ->orWhere('designation_bn', 'like', "%{$term}%")
                    ->orWhere('designation_en', 'like', "%{$term}%");
            });
        }

        $staff = $query->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(12)
            ->withQueryString();

        return view(
            'frontend.staff',
            compact('websiteSetting', 'staff')
        );
    }

    public function students()
    {
        $websiteSetting = WebsiteSetting::first();

        $totalStudents = Student::where('status', 1)->count();
        $boysCount = Student::where('status', 1)->where('gender', 'Male')->count();
        $girlsCount = Student::where('status', 1)->where('gender', 'Female')->count();

        $classStats = Student::where('status', 1)
            ->select('class', DB::raw('count(*) as total'), DB::raw('SUM(CASE WHEN gender="Male" THEN 1 ELSE 0 END) as boys'), DB::raw('SUM(CASE WHEN gender="Female" THEN 1 ELSE 0 END) as girls'))
            ->groupBy('class')
            ->orderBy('class')
            ->get();

        return view(
            'frontend.students',
            compact('websiteSetting', 'totalStudents', 'boysCount', 'girlsCount', 'classStats')
        );
    }

    public function studentList(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $query = Student::where('status', 1)
            ->orderBy('class')
            ->orderBy('roll_no');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('section')) {
            $query->where('section', $request->section);
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('name_bn', 'like', "%{$term}%")
                    ->orWhere('name_en', 'like', "%{$term}%")
                    ->orWhere('student_id', 'like', "%{$term}%")
                    ->orWhere('roll_no', 'like', "%{$term}%");
            });
        }

        $students = $query->paginate(20)->withQueryString();

        $classes = Student::where('status', 1)->distinct()->pluck('class');
        $sections = Student::where('status', 1)->whereNotNull('section')->distinct()->pluck('section');
        $years = Student::where('status', 1)->distinct()->pluck('academic_year');

        return view(
            'frontend.student-list',
            compact('websiteSetting', 'students', 'classes', 'sections', 'years')
        );
    }

    public function magazine()
    {
        $websiteSetting = WebsiteSetting::first();

        $magazines = SchoolPublication::where('status', 1)
            ->where('type', 'magazine')
            ->orderBy('sort_order')
            ->latest('publish_date')
            ->paginate(12);

        return view(
            'frontend.magazine',
            compact('websiteSetting', 'magazines')
        );
    }

    public function publications()
    {
        $websiteSetting = WebsiteSetting::first();

        $publications = SchoolPublication::where('status', 1)
            ->where('type', 'publication')
            ->orderBy('sort_order')
            ->latest('publish_date')
            ->paginate(12);

        return view(
            'frontend.publications',
            compact('websiteSetting', 'publications')
        );
    }

    public function gallery()
    {
        $websiteSetting = WebsiteSetting::first();

        $galleries = Gallery::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12);

        return view(
            'frontend.gallery',
            compact('websiteSetting', 'galleries')
        );
    }

    public function videoGallery()
    {
        $websiteSetting = WebsiteSetting::first();

        $videos = VideoGallery::where('status', 1)
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12);

        $categories = VideoGallery::where('status', 1)->get()->map(function($v) {
            return $v->category;
        })->filter()->unique();

        return view(
            'frontend.video-gallery',
            compact('websiteSetting', 'videos', 'categories')
        );
    }

    public function contact()
    {
        $websiteSetting = WebsiteSetting::first();

        return view(
            'frontend.contact',
            compact('websiteSetting')
        );
    }

    public function admission()
    {
        $websiteSetting = WebsiteSetting::first();

        $admissions = Admission::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $fees = AdmissionFee::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'frontend.admission',
            compact('websiteSetting', 'admissions', 'fees')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Online Admission Page
    |--------------------------------------------------------------------------
    */

    public function onlineAdmission()
    {
        $websiteSetting = WebsiteSetting::first();

        return view(
            'frontend.online-admission',
            compact('websiteSetting')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Online Admission Store
    |--------------------------------------------------------------------------
    */

    public function onlineAdmissionStore(Request $request)
    {
        // Simple captcha check if submitted
        if ($request->filled('captcha_num1') && $request->filled('captcha_num2')) {
            $expected = (int)$request->captcha_num1 + (int)$request->captcha_num2;
            if ((int)$request->captcha_answer !== $expected) {
                return redirect()->back()->withInput()->withErrors([
                    'captcha_answer' => 'ক্যাপচা উত্তর সঠিক নয়। অনুগ্রহ করে পুনরায় যোগফল দিন।'
                ]);
            }
        }

        $validated = $request->validate([
            'academic_year' => ['nullable', 'string', 'max:10'],
            'student_name' => ['required', 'string', 'max:255'],
            'student_name_bn' => ['nullable', 'string', 'max:255'],
            'student_name_en' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:male,female,other'],
            'class' => ['required', 'string', 'max:100'],
            'group_name' => ['nullable', 'string', 'max:100'],
            'blood_group' => ['nullable', 'string', 'max:10'],
            'birth_reg_no' => ['nullable', 'string', 'max:30'],
            'religion' => ['nullable', 'string', 'max:50'],
            'nationality' => ['nullable', 'string', 'max:50'],
            'previous_school' => ['nullable', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'father_name_en' => ['nullable', 'string', 'max:255'],
            'father_nid' => ['nullable', 'string', 'max:30'],
            'father_education' => ['nullable', 'string', 'max:100'],
            'father_occupation_info' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'mother_name_en' => ['nullable', 'string', 'max:255'],
            'mother_nid' => ['nullable', 'string', 'max:30'],
            'mother_education' => ['nullable', 'string', 'max:100'],
            'present_address' => ['nullable', 'string', 'max:1000'],
            'permanent_address' => ['nullable', 'string', 'max:1000'],
            'address' => ['nullable', 'string', 'max:1000'],
            'guardian_info' => ['nullable', 'string', 'max:500'],
            'other_children_info' => ['nullable', 'string', 'max:500'],
            'guardian_phone' => ['required', 'string', 'regex:/^01[3-9]\d{8}$/'],
            'contact_mobile' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'student_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'birth_certificate' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'],
        ], [
            'student_name.required' => 'শিক্ষার্থীর নাম লিখুন।',
            'student_name.max' => 'শিক্ষার্থীর নাম সর্বোচ্চ ২৫৫ অক্ষরের মধ্যে হতে হবে।',
            'date_of_birth.required' => 'জন্ম তারিখ নির্বাচন করুন।',
            'date_of_birth.before' => 'জন্ম তারিখ আজকের পূর্বের তারিখ হতে হবে।',
            'gender.required' => 'শিক্ষার্থীর লিঙ্গ নির্বাচন করুন।',
            'gender.in' => 'সঠিক লিঙ্গ নির্বাচন করুন।',
            'class.required' => 'যে শ্রেণিতে ভর্তি হতে ইচ্ছুক তা নির্বাচন করুন।',
            'father_name.required' => 'পিতার নাম লিখুন।',
            'mother_name.required' => 'মাতার নাম লিখুন।',
            'guardian_phone.required' => 'অভিভাবকের মোবাইল নম্বর আবশ্যক।',
            'guardian_phone.regex' => 'সঠিক ১১ ডিজিটের মোবাইল নম্বর দিন (যেমন: 017XXXXXXXX)।',
            'email.email' => 'সঠিক ই-মেইল ঠিকানা দিন।',
            'student_photo.required' => 'শিক্ষার্থীর পাসপোর্ট সাইজের ছবি আপলোড করা আবশ্যক।',
            'student_photo.image' => 'ছবি ফাইল সঠিক ফরম্যাটে হতে হবে (jpg, jpeg, png, webp)।',
            'student_photo.mimes' => 'ছবি jpg, jpeg, png অথবা webp ফরম্যাটে হতে হবে।',
            'student_photo.max' => 'ছবির সাইজ সর্বোচ্চ 2MB হতে পারবে।',
            'birth_certificate.mimes' => 'জন্ম নিবন্ধন ফাইল jpg, jpeg, png অথবা pdf ফরম্যাটে হতে হবে।',
            'birth_certificate.max' => 'জন্ম নিবন্ধন ফাইলের সাইজ সর্বোচ্চ 4MB হতে পারবে।',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Unique Application Number (BLSC-YYYY-XXXXX)
        |--------------------------------------------------------------------------
        */
        $acadYear = $validated['academic_year'] ?? date('Y');
        do {
            $applicationNo = 'BLSC-' . $acadYear . '-' . strtoupper(Str::random(5));
        } while (AdmissionApplication::where('application_no', $applicationNo)->exists());

        $presentAddr = $validated['present_address'] ?? $validated['address'] ?? 'N/A';
        $permanentAddr = $validated['permanent_address'] ?? $presentAddr;

        $application = new AdmissionApplication();
        $application->application_no = $applicationNo;
        $application->academic_year = $acadYear;
        $application->student_name = $validated['student_name'];
        $application->student_name_bn = $validated['student_name_bn'] ?? $validated['student_name'];
        $application->student_name_en = $validated['student_name_en'] ?? $validated['student_name'];
        $application->date_of_birth = $validated['date_of_birth'];
        $application->gender = $validated['gender'];
        $application->class = $validated['class'];
        $application->group_name = $validated['group_name'] ?? null;
        $application->blood_group = $validated['blood_group'] ?? null;
        $application->birth_reg_no = $validated['birth_reg_no'] ?? null;
        $application->religion = $validated['religion'] ?? null;
        $application->nationality = $validated['nationality'] ?? 'Bangladeshi';
        $application->previous_school = $validated['previous_school'] ?? null;
        $application->father_name = $validated['father_name'];
        $application->father_name_en = $validated['father_name_en'] ?? null;
        $application->father_nid = $validated['father_nid'] ?? null;
        $application->father_education = $validated['father_education'] ?? null;
        $application->father_occupation_info = $validated['father_occupation_info'] ?? null;
        $application->mother_name = $validated['mother_name'];
        $application->mother_name_en = $validated['mother_name_en'] ?? null;
        $application->mother_nid = $validated['mother_nid'] ?? null;
        $application->mother_education = $validated['mother_education'] ?? null;
        $application->guardian_phone = $validated['guardian_phone'];
        $application->contact_mobile = $validated['contact_mobile'] ?? $validated['guardian_phone'];
        $application->email = $validated['email'] ?? null;
        $application->present_address = $presentAddr;
        $application->permanent_address = $permanentAddr;
        $application->address = $presentAddr;
        $application->guardian_info = $validated['guardian_info'] ?? null;
        $application->other_children_info = $validated['other_children_info'] ?? null;
        $application->status = 'pending';

        /*
        |--------------------------------------------------------------------------
        | Student Photo Upload
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('student_photo')) {
            $image = $request->file('student_photo');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $photoDir = public_path('uploads/admission/photos');
            if (!file_exists($photoDir)) {
                mkdir($photoDir, 0755, true);
            }
            $image->move($photoDir, $filename);
            $application->student_photo = 'uploads/admission/photos/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | Birth Certificate Upload
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('birth_certificate')) {
            $file = $request->file('birth_certificate');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $docDir = public_path('uploads/admission/documents');
            if (!file_exists($docDir)) {
                mkdir($docDir, 0755, true);
            }
            $file->move($docDir, $filename);
            $application->birth_certificate = 'uploads/admission/documents/' . $filename;
        }

        $application->save();

        /*
        |--------------------------------------------------------------------------
        | Email Notification
        |--------------------------------------------------------------------------
        */
        if ($application->email) {
            try {
                Mail::to($application->email)->send(
                    new AdmissionApplicationSubmittedMail($application)
                );
            } catch (\Throwable $e) {
                Log::error('Admission application email failed.', [
                    'application_no' => $application->application_no,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SMS Notification
        |--------------------------------------------------------------------------
        */
        try {
            $smsMessage = "BIAM School: Online admission application submitted. App No: {$application->application_no}. Student: {$application->student_name}. Please pay admission fee to proceed.";
            app(SmsService::class)->send($application->guardian_phone, $smsMessage);
        } catch (\Throwable $e) {
            Log::error('Admission application SMS failed.', [
                'application_no' => $application->application_no,
                'error' => $e->getMessage(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Session & Redirect to Confirmation Page
        |--------------------------------------------------------------------------
        */
        session()->put('application_no', $application->application_no);

        return redirect()
            ->route('online-admission.confirmation', ['applicationNo' => $application->application_no])
            ->with('success', 'আপনার ভর্তি আবেদন সফলভাবে গৃহীত হয়েছে!');
    }

    /*
    |--------------------------------------------------------------------------
    | Online Admission Confirmation Page
    |--------------------------------------------------------------------------
    */
    public function onlineAdmissionConfirmation($applicationNo)
    {
        $websiteSetting = WebsiteSetting::first();
        $application = AdmissionApplication::where('application_no', $applicationNo)->firstOrFail();

        $fees = AdmissionFee::where('status', 1)->where('is_delete', 0)->get();
        $totalFee = (float) $fees->sum('amount');
        if ($totalFee <= 0) {
            $totalFee = 500.00;
        }

        return view(
            'frontend.online-admission-confirmation',
            compact('websiteSetting', 'application', 'fees', 'totalFee')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Download Admission Application PDF
    |--------------------------------------------------------------------------
    */
    public function downloadAdmissionApplicationPdf($applicationNo)
    {
        $application = AdmissionApplication::where(
            'application_no',
            $applicationNo
        )->firstOrFail();

        $websiteSetting = WebsiteSetting::first();

        try {
            $fontPath = str_replace('\\', '/', public_path('fonts/Kalpurush/kalpurush.ttf'));

            if (!file_exists($fontPath)) {
                return response(
                    'Kalpurush font পাওয়া যায়নি: ' . $fontPath,
                    500
                );
            }

            $pdf = Pdf::loadView(
                'frontend.admission.application-pdf',
                [
                    'application' => $application,
                    'websiteSetting' => $websiteSetting,
                ]
            );

            $pdf->setPaper('A4', 'portrait');

            /*
            |--------------------------------------------------------------------------
            | Register Kalpurush Font for all weights and styles to prevent DomPDF
            | from falling back to Helvetica-Bold for bold Bengali headings & titles!
            |--------------------------------------------------------------------------
            */
            $dompdf = $pdf->getDomPDF();
            $fontMetrics = $dompdf->getFontMetrics();

            $styles = ['normal', 'italic'];
            $weights = ['normal', 'bold', 'bolder', '500', '600', '700', '800', '900'];
            foreach (['Kalpurush', 'kalpurush'] as $family) {
                foreach ($styles as $style) {
                    foreach ($weights as $weight) {
                        $fontMetrics->registerFont(
                            ['family' => $family, 'style' => $style, 'weight' => $weight],
                            $fontPath
                        );
                    }
                }
            }

            return $pdf->download(
                'Application-' . $application->application_no . '.pdf'
            );

        } catch (\Throwable $e) {

            Log::error('Admission PDF Error', [
                'application_no' => $applicationNo,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response(
                '<h3>Application PDF তৈরি করা সম্ভব হয়নি।</h3>' .
                '<p>' . e($e->getMessage()) . '</p>',
                500
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Download Admission Admit Card PDF
    |--------------------------------------------------------------------------
    */
    public function downloadAdmissionAdmitCardPdf($applicationNo)
    {
        $application = AdmissionApplication::where('application_no', $applicationNo)->firstOrFail();
        $websiteSetting = WebsiteSetting::first();

        try {
            $fontPath = str_replace('\\', '/', public_path('fonts/Kalpurush/kalpurush.ttf'));
            $pdf = Pdf::loadView('frontend.admission.admit-card-pdf', [
                'application' => $application,
                'websiteSetting' => $websiteSetting,
            ]);
            $pdf->setPaper('A4', 'portrait');

            $dompdf = $pdf->getDomPDF();
            $fontMetrics = $dompdf->getFontMetrics();
            $styles = ['normal', 'italic'];
            $weights = ['normal', 'bold', 'bolder', '500', '600', '700', '800', '900'];
            foreach (['Kalpurush', 'kalpurush'] as $family) {
                foreach ($styles as $style) {
                    foreach ($weights as $weight) {
                        $fontMetrics->registerFont(
                            ['family' => $family, 'style' => $style, 'weight' => $weight],
                            $fontPath
                        );
                    }
                }
            }

            return $pdf->download('AdmitCard-' . $application->application_no . '.pdf');
        } catch (\Throwable $e) {
            Log::error('Admit Card PDF Error', ['error' => $e->getMessage()]);
            return response('<h3>প্রবেশপত্র তৈরি করা সম্ভব হয়নি।</h3><p>' . e($e->getMessage()) . '</p>', 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Download Admission Receipt PDF
    |--------------------------------------------------------------------------
    */
    public function downloadAdmissionReceiptPdf($applicationNo)
    {
        $application = AdmissionApplication::with('payments')->where('application_no', $applicationNo)->firstOrFail();
        $websiteSetting = WebsiteSetting::first();

        try {
            $fontPath = str_replace('\\', '/', public_path('fonts/Kalpurush/kalpurush.ttf'));
            $pdf = Pdf::loadView('frontend.admission.receipt-pdf', [
                'application' => $application,
                'websiteSetting' => $websiteSetting,
            ]);
            $pdf->setPaper('A4', 'portrait');

            $dompdf = $pdf->getDomPDF();
            $fontMetrics = $dompdf->getFontMetrics();
            $styles = ['normal', 'italic'];
            $weights = ['normal', 'bold', 'bolder', '500', '600', '700', '800', '900'];
            foreach (['Kalpurush', 'kalpurush'] as $family) {
                foreach ($styles as $style) {
                    foreach ($weights as $weight) {
                        $fontMetrics->registerFont(
                            ['family' => $family, 'style' => $style, 'weight' => $weight],
                            $fontPath
                        );
                    }
                }
            }

            return $pdf->download('Receipt-' . $application->application_no . '.pdf');
        } catch (\Throwable $e) {
            Log::error('Receipt PDF Error', ['error' => $e->getMessage()]);
            return response('<h3>মানি রিসিট তৈরি করা সম্ভব হয়নি।</h3><p>' . e($e->getMessage()) . '</p>', 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Admission Fee
    |--------------------------------------------------------------------------
    */

    public function admissionFee(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();

        $applicationNo = $request->query('application_no');

        $application = null;

        if ($applicationNo) {
            $application = AdmissionApplication::where(
                'application_no',
                $applicationNo
            )->first();
        }

        $fees = AdmissionFee::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $totalFee = $fees->sum('amount');

        return view(
            'frontend.admission-fee',
            compact(
                'websiteSetting',
                'application',
                'fees',
                'totalFee',
                'applicationNo'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store Admission Fee Payment
    |--------------------------------------------------------------------------
    */
    public function admissionFeeStore(Request $request)
    {
        $validated = $request->validate([
            'application_no' => ['required', 'string', 'exists:admission_applications,application_no'],
            'payment_method' => ['required', 'string', 'in:bkash,nagad,rocket,bank,sslcommerz'],
            'account_number' => ['required_unless:payment_method,sslcommerz', 'nullable', 'string', 'max:50'],
            'transaction_id' => ['required_unless:payment_method,sslcommerz', 'nullable', 'string', 'max:100'],
            'payment_proof' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'],
        ], [
            'application_no.required' => 'আবেদন নম্বর (Application No.) প্রদান করুন।',
            'application_no.exists' => 'প্রদত্ত Application No. অনুযায়ী কোনো আবেদন পাওয়া যায়নি।',
            'payment_method.required' => 'পেমেন্ট মাধ্যম নির্বাচন করুন (bKash, Nagad, Rocket, Bank অথবা SSLCOMMERZ)।',
            'payment_method.in' => 'অনুমোদিত পেমেন্ট মাধ্যম নির্বাচন করুন।',
            'account_number.required_unless' => 'যে মোবাইল/অ্যাকাউন্ট নম্বর থেকে পেমেন্ট করেছেন তা লিখুন।',
            'transaction_id.required_unless' => 'পেমেন্টের Transaction ID লিখুন।',
            'payment_proof.mimes' => 'পেমেন্ট রসিদ jpg, jpeg, png অথবা pdf ফরম্যাটে হতে হবে।',
            'payment_proof.max' => 'পেমেন্ট রসিদের সাইজ সর্বোচ্চ 4MB হতে পারবে।',
        ]);

        $application = AdmissionApplication::where('application_no', $validated['application_no'])->firstOrFail();

        // Calculate payable fees
        $fees = AdmissionFee::where('status', 1)->where('is_delete', 0)->get();
        $amount = (float) $fees->sum('amount');
        if ($amount <= 0) {
            $amount = 500.00;
        }

        // Generate unique payment number (PAY-YYYYMMDD-XXXXXX)
        do {
            $paymentNo = 'PAY-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (AdmissionPayment::where('payment_no', $paymentNo)->exists());

        // Handle SSLCOMMERZ Payment Gateway
        if ($validated['payment_method'] === 'sslcommerz') {
            $payment = AdmissionPayment::create([
                'admission_application_id' => $application->id,
                'payment_no' => $paymentNo,
                'amount' => $amount,
                'payment_method' => 'sslcommerz',
                'account_number' => $request->account_number ?: $application->guardian_phone,
                'transaction_id' => 'INIT-' . strtoupper(Str::random(8)),
                'status' => 'pending',
                'paid_at' => now(),
            ]);

            $sslService = app(SslCommerzService::class);
            $initResult = $sslService->initiatePayment($application, $amount, $paymentNo);

            if (!empty($initResult['redirect_url'])) {
                return redirect()->away($initResult['redirect_url']);
            }

            return redirect()->route('admission-fee.sslcommerz.simulate', ['payment_no' => $paymentNo]);
        }

        // Handle Manual MFS / Bank (bKash, Nagad, Rocket, Bank)
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $dir = public_path('uploads/admission/payments');
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $file->move($dir, $filename);
            $proofPath = 'uploads/admission/payments/' . $filename;
        }

        $payment = AdmissionPayment::create([
            'admission_application_id' => $application->id,
            'payment_no' => $paymentNo,
            'amount' => $amount,
            'payment_method' => $validated['payment_method'],
            'account_number' => $validated['account_number'],
            'transaction_id' => strtoupper(trim($validated['transaction_id'])),
            'payment_proof' => $proofPath,
            'status' => 'pending',
            'paid_at' => now(),
        ]);

        $application->update([
            'status' => 'payment_pending',
        ]);

        // Email Notification
        if ($application->email) {
            try {
                Mail::to($application->email)->send(new AdmissionPaymentSubmittedMail($payment));
            } catch (\Throwable $e) {
                Log::error('Payment email error: ' . $e->getMessage());
            }
        }

        // SMS Notification
        try {
            $sms = "BIAM School: Payment info received for App No: {$application->application_no}. TrxID: {$payment->transaction_id}. Amount: Tk {$payment->amount}. Receipt No: {$payment->payment_no}";
            app(SmsService::class)->send($application->guardian_phone, $sms);
        } catch (\Throwable $e) {
            Log::error('Payment SMS error: ' . $e->getMessage());
        }

        return redirect()->route('admission-payment.receipt', $payment->id)
            ->with('success', 'আপনার পেমেন্ট তথ্য সফলভাবে জমা হয়েছে। যাচাইকরণ সাপেক্ষে ভর্তি নিশ্চিত করা হবে।');
    }

    /*
    |--------------------------------------------------------------------------
    | Admission Payment Receipt View
    |--------------------------------------------------------------------------
    */
    public function admissionPaymentReceipt($payment)
    {
        $websiteSetting = WebsiteSetting::first();
        $paymentRecord = AdmissionPayment::with('application')->findOrFail($payment);

        return view('frontend.admission-payment-receipt', [
            'payment' => $paymentRecord,
            'websiteSetting' => $websiteSetting,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SSLCOMMERZ Simulation (For Local Development / Sandbox Testing)
    |--------------------------------------------------------------------------
    */
    public function sslcommerzSimulate($payment_no)
    {
        $payment = AdmissionPayment::with('application')->where('payment_no', $payment_no)->firstOrFail();
        $websiteSetting = WebsiteSetting::first();

        return view('frontend.admission.sslcommerz-simulate', compact('payment', 'websiteSetting'));
    }

    /*
    |--------------------------------------------------------------------------
    | SSLCOMMERZ Success Callback
    |--------------------------------------------------------------------------
    */
    public function sslcommerzSuccess(Request $request)
    {
        $tranId = $request->input('tran_id') ?? $request->input('value_b');
        $payment = AdmissionPayment::where('payment_no', $tranId)->first();

        if (!$payment) {
            return redirect()->route('admission-fee')->withErrors(['error' => 'পেমেন্ট রেকর্ড পাওয়া যায়নি।']);
        }

        $payment->update([
            'status' => 'approved',
            'transaction_id' => $request->input('bank_tran_id') ?: ('SSLCZ-' . strtoupper(Str::random(10))),
            'account_number' => $request->input('card_no') ?: ($payment->account_number ?: 'SSLCOMMERZ-GATEWAY'),
            'admin_note' => 'Paid via SSLCOMMERZ gateway (' . ($request->input('card_type') ?: 'Online Payment') . ')',
            'verified_at' => now(),
        ]);

        $payment->application->update([
            'status' => 'approved',
        ]);

        if ($payment->application->email) {
            try {
                Mail::to($payment->application->email)->send(new AdmissionPaymentSubmittedMail($payment));
            } catch (\Throwable $e) {
                Log::error('SSLCommerz success email error: ' . $e->getMessage());
            }
        }

        try {
            $sms = "BIAM School: Admission fee Tk {$payment->amount} paid successfully via SSLCOMMERZ. App No: {$payment->application->application_no}. TrxID: {$payment->transaction_id}. Admission Confirmed!";
            app(SmsService::class)->send($payment->application->guardian_phone, $sms);
        } catch (\Throwable $e) {
            Log::error('SSLCommerz success SMS error: ' . $e->getMessage());
        }

        return redirect()->route('admission-payment.receipt', $payment->id)
            ->with('success', 'SSLCOMMERZ-এর মাধ্যমে পেমেন্ট সফলভাবে সম্পন্ন হয়েছে এবং ভর্তি নিশ্চিত হয়েছে!');
    }

    /*
    |--------------------------------------------------------------------------
    | SSLCOMMERZ Fail Callback
    |--------------------------------------------------------------------------
    */
    public function sslcommerzFail(Request $request)
    {
        $tranId = $request->input('tran_id') ?? $request->input('value_b');
        $payment = AdmissionPayment::where('payment_no', $tranId)->first();

        if ($payment) {
            $payment->update([
                'status' => 'rejected',
                'admin_note' => 'SSLCOMMERZ payment failed: ' . ($request->input('error') ?: 'Transaction failed at gateway'),
            ]);
            $appNo = $payment->application->application_no;
        } else {
            $appNo = null;
        }

        return redirect()->route('admission-fee', array_filter(['application_no' => $appNo]))
            ->withErrors(['error' => 'SSLCOMMERZ পেমেন্ট সম্পন্ন করা সম্ভব হয়নি। অনুগ্রহ করে পুনরায় চেষ্টা করুন বা bKash/Nagad/Rocket মাধ্যমে পেমেন্ট করুন।']);
    }

    /*
    |--------------------------------------------------------------------------
    | SSLCOMMERZ Cancel Callback
    |--------------------------------------------------------------------------
    */
    public function sslcommerzCancel(Request $request)
    {
        $tranId = $request->input('tran_id') ?? $request->input('value_b');
        $payment = AdmissionPayment::where('payment_no', $tranId)->first();
        $appNo = $payment ? $payment->application->application_no : null;

        return redirect()->route('admission-fee', array_filter(['application_no' => $appNo]))
            ->with('info', 'পেমেন্ট প্রক্রিয়া বাতিল করা হয়েছে। আপনি চাইলে অন্য কোনো মাধ্যমে পেমেন্ট করতে পারেন।');
    }

    /*
    |--------------------------------------------------------------------------
    | SSLCOMMERZ IPN Callback
    |--------------------------------------------------------------------------
    */
    public function sslcommerzIpn(Request $request)
    {
        $tranId = $request->input('tran_id');
        $status = $request->input('status');

        if ($status === 'VALID' && $tranId) {
            $payment = AdmissionPayment::where('payment_no', $tranId)->first();
            if ($payment && $payment->status !== 'approved') {
                $payment->update([
                    'status' => 'approved',
                    'transaction_id' => $request->input('bank_tran_id') ?: $tranId,
                    'verified_at' => now(),
                ]);
                $payment->application->update(['status' => 'approved']);
            }
        }

        return response()->json(['status' => 'success']);
    }

    /*
    |--------------------------------------------------------------------------
    | Switch Language (BN <-> EN)
    |--------------------------------------------------------------------------
    */
    public function switchLanguage($lang)
    {
        if (in_array($lang, ['bn', 'en'])) {
            session(['locale' => $lang]);
            app()->setLocale($lang);
        }

        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | Re-Download Application / Admit Card (Reference: download.php)
    |--------------------------------------------------------------------------
    */
    public function admissionDownload(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();
        $application = null;

        if ($request->filled('app_no')) {
            $application = AdmissionApplication::with('payments')
                ->where('application_no', trim($request->app_no))
                ->first();
        }

        return view('frontend.online-admission-download', compact('websiteSetting', 'application'));
    }

    /*
    |--------------------------------------------------------------------------
    | Search Application for Re-Download
    |--------------------------------------------------------------------------
    */
    public function admissionDownloadSearch(Request $request)
    {
        $searchType = $request->input('search_type', 'app_no');
        $application = null;

        if ($searchType === 'app_no') {
            $request->validate([
                'application_no' => 'required|string|max:50',
            ], [
                'application_no.required' => 'আবেদন নম্বর (Application No) প্রদান করুন।',
            ]);

            $application = AdmissionApplication::with('payments')
                ->where('application_no', trim($request->application_no))
                ->first();
        } else {
            $request->validate([
                'guardian_phone' => 'required|string',
                'date_of_birth' => 'required|date',
            ], [
                'guardian_phone.required' => 'অভিভাবকের মোবাইল নম্বর প্রদান করুন।',
                'date_of_birth.required' => 'শিক্ষার্থীর জন্ম তারিখ নির্বাচন করুন।',
            ]);

            $application = AdmissionApplication::with('payments')
                ->where('guardian_phone', trim($request->guardian_phone))
                ->whereDate('date_of_birth', $request->date_of_birth)
                ->latest()
                ->first();
        }

        if (!$application) {
            return redirect()->back()->withInput()->with('error', 'প্রদত্ত তথ্য অনুযায়ী কোনো আবেদন পাওয়া যায়নি। অনুগ্রহ করে সঠিক আবেদন নম্বর অথবা মোবাইল ও জন্ম তারিখ দিয়ে চেষ্টা করুন।');
        }

        $websiteSetting = WebsiteSetting::first();
        return view('frontend.online-admission-download', compact('websiteSetting', 'application'));
    }

    /*
    |--------------------------------------------------------------------------
    | Public Digital Lottery Result & Merit List
    |--------------------------------------------------------------------------
    */
    public function lotteryResult(Request $request)
    {
        $websiteSetting = WebsiteSetting::first();
        $academicYear = $request->input('academic_year', date('Y'));
        $selectedClass = $request->input('class', '');

        // Fetch distinct classes that have applications in this academic year
        $classes = AdmissionApplication::where('academic_year', $academicYear)
            ->whereNotNull('class')
            ->distinct()
            ->pluck('class');

        if ($classes->isEmpty()) {
            $classes = AdmissionApplication::distinct()->pluck('class');
        }

        if (!$selectedClass && $classes->isNotEmpty()) {
            $selectedClass = $classes->first();
        }

        $query = AdmissionApplication::query()
            ->where('academic_year', $academicYear);

        if ($selectedClass) {
            $query->where('class', $selectedClass);
        }

        // Selected candidates (merit list)
        $selectedCandidates = (clone $query)
            ->where('is_lottery_selected', 1)
            ->orderBy('lottery_rank')
            ->get();

        // Waiting list candidates
        $waitingCandidates = (clone $query)
            ->where('lottery_quota', 'waiting')
            ->orderBy('lottery_rank')
            ->get();

        // All registered candidates in this class/year
        $totalApplicants = (clone $query)->count();
        $totalSelected = $selectedCandidates->count();
        $totalWaiting = $waitingCandidates->count();

        return view('frontend.admission.lottery-result', compact(
            'websiteSetting',
            'academicYear',
            'selectedClass',
            'classes',
            'selectedCandidates',
            'waitingCandidates',
            'totalApplicants',
            'totalSelected',
            'totalWaiting'
        ));
    }
}