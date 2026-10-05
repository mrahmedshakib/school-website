<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Frontend\FrontendController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AdministrationController;
use App\Http\Controllers\Admin\MissionVisionController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\AdmissionApplicationController;
use App\Http\Controllers\Admin\AdmissionPaymentController;
use App\Http\Controllers\Admin\AcademicSyllabusController;
use App\Http\Controllers\Admin\ClassRoutineController;
use App\Http\Controllers\Admin\ExamRoutineController;
use App\Http\Controllers\Admin\AcademicSubjectController;
use App\Http\Controllers\Admin\ExamResultController;
use App\Http\Controllers\Admin\StudentMarkController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Admin\VideoGalleryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::middleware('track.visitor')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
    Route::get('/mission-vision', [FrontendController::class, 'missionVision'])->name('mission-vision');
    Route::get('/leadership', [FrontendController::class, 'leadership'])->name('leadership');
    Route::get('/administration', [FrontendController::class, 'administration'])->name('administration');
    Route::get('/notice', [FrontendController::class, 'notice'])->name('notice');
    Route::get('/syllabus', [FrontendController::class, 'syllabus'])->name('syllabus');
    Route::get('/class-routine', [FrontendController::class, 'classRoutine'])->name('class-routine');
    Route::get('/exam-routine', [FrontendController::class, 'examRoutine'])->name('exam-routine');
    Route::get('/subjects', [FrontendController::class, 'subjects'])->name('subjects');
    Route::get('/results', [FrontendController::class, 'results'])->name('results');
    Route::get('/teachers', [FrontendController::class, 'teachers'])->name('teachers');
    Route::get('/staff', [FrontendController::class, 'staff'])->name('staff');
    Route::get('/students', [FrontendController::class, 'students'])->name('students');
    Route::get('/student-list', [FrontendController::class, 'studentList'])->name('student-list');
    Route::get('/result', [FrontendController::class, 'result'])->name('result');
    Route::get('/magazine', [FrontendController::class, 'magazine'])->name('magazine');
    Route::get('/publications', [FrontendController::class, 'publications'])->name('publications');
    Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
    Route::get('/video-gallery', [FrontendController::class, 'videoGallery'])->name('video-gallery');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
    Route::post('/contact', [FrontendController::class, 'contactStore'])->name('contact.store');

    Route::get('/admission', [FrontendController::class, 'admission'])->name('admission');

    Route::get('/online-admission', [FrontendController::class, 'onlineAdmission'])
        ->name('online-admission');

    Route::post('/online-admission', [FrontendController::class, 'onlineAdmissionStore'])
        ->name('online-admission.store');

    Route::get(
        '/online-admission/confirmation/{applicationNo}',
        [FrontendController::class, 'onlineAdmissionConfirmation']
    )->name('online-admission.confirmation');

    Route::get(
        '/online-admission/application/{applicationNo}/pdf',
        [FrontendController::class, 'downloadAdmissionApplicationPdf']
    )->name('online-admission.pdf');

    Route::get(
        '/online-admission/application/{applicationNo}/application-pdf',
        [FrontendController::class, 'downloadAdmissionApplicationPdf']
    )->name('online-admission.application.pdf');

    Route::get(
        '/online-admission/application/{applicationNo}/admit-card',
        [FrontendController::class, 'downloadAdmissionAdmitCardPdf']
    )->name('online-admission.admit-card');

    Route::get(
        '/online-admission/application/{applicationNo}/receipt',
        [FrontendController::class, 'downloadAdmissionReceiptPdf']
    )->name('online-admission.receipt');

    Route::get('/admission-fee', [FrontendController::class, 'admissionFee'])
        ->name('admission-fee');

    Route::post('/admission-fee', [FrontendController::class, 'admissionFeeStore'])
        ->name('admission-fee.store');

    Route::get(
        '/admission-payment/{payment}/receipt',
        [FrontendController::class, 'admissionPaymentReceipt']
    )->name('admission-payment.receipt');

    // Language Switcher
    Route::get('/locale/{lang}', [FrontendController::class, 'switchLanguage'])->name('locale.switch');

    // Re-Download Application / Admit Card (Reference: download.php)
    Route::get('/online-admission/download', [FrontendController::class, 'admissionDownload'])
        ->name('online-admission.download');
    Route::post('/online-admission/download', [FrontendController::class, 'admissionDownloadSearch'])
        ->name('online-admission.download.search');

    // Digital Lottery & Merit List
    Route::get('/admission/lottery-result', [FrontendController::class, 'lotteryResult'])
        ->name('admission.lottery');

    // SSLCOMMERZ Payment Routes
    Route::get(
        '/admission-fee/sslcommerz/simulate/{payment_no}',
        [FrontendController::class, 'sslcommerzSimulate']
    )->name('admission-fee.sslcommerz.simulate');

    Route::post(
        '/admission-fee/sslcommerz/success',
        [FrontendController::class, 'sslcommerzSuccess']
    )->name('admission-fee.sslcommerz.success');

    Route::post(
        '/admission-fee/sslcommerz/fail',
        [FrontendController::class, 'sslcommerzFail']
    )->name('admission-fee.sslcommerz.fail');

    Route::post(
        '/admission-fee/sslcommerz/cancel',
        [FrontendController::class, 'sslcommerzCancel']
    )->name('admission-fee.sslcommerz.cancel');

    Route::post(
        '/admission-fee/sslcommerz/ipn',
        [FrontendController::class, 'sslcommerzIpn']
    )->name('admission-fee.sslcommerz.ipn');

    Route::get('/news', [FrontendController::class, 'news'])->name('news');
    Route::get('/news/{slug}', [FrontendController::class, 'newsDetails'])->name('news.details');

    Route::get('/events', [FrontendController::class, 'events'])->name('events');
    Route::get('/events/{slug}', [FrontendController::class, 'eventDetails'])->name('events.details');

    Route::get('/downloads', [FrontendController::class, 'downloads'])->name('downloads');
    Route::get('/important-links', [FrontendController::class, 'importantLinks'])->name('important-links');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard')
            ->middleware('permission:dashboard.view');

        /*
        |--------------------------------------------------------------------------
        | Website Settings
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:settings.manage')->group(function () {
            Route::get('/settings', [WebsiteSettingController::class, 'edit'])->name('settings.edit');
            Route::put('/settings', [WebsiteSettingController::class, 'update'])->name('settings.update');
        });

        /*
        |--------------------------------------------------------------------------
        | About & Mission-Vision (Institutional About)
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:institution.about')->group(function () {
            Route::get('/abouts', [AboutController::class, 'index'])->name('abouts.index');
            Route::get('/abouts/create', [AboutController::class, 'create'])->name('abouts.create');
            Route::post('/abouts', [AboutController::class, 'store'])->name('abouts.store');
            Route::get('/abouts/{id}/edit', [AboutController::class, 'edit'])->name('abouts.edit');
            Route::put('/abouts/{id}', [AboutController::class, 'update'])->name('abouts.update');
            Route::patch('/abouts/{id}/toggle-status', [AboutController::class, 'toggleStatus'])->name('abouts.toggle-status');
            Route::delete('/abouts/{id}', [AboutController::class, 'destroy'])->name('abouts.destroy');

            Route::get('/mission-visions', [MissionVisionController::class, 'index'])->name('mission-visions.index');
            Route::get('/mission-visions/create', [MissionVisionController::class, 'create'])->name('mission-visions.create');
            Route::post('/mission-visions', [MissionVisionController::class, 'store'])->name('mission-visions.store');
            Route::get('/mission-visions/{id}/edit', [MissionVisionController::class, 'edit'])->name('mission-visions.edit');
            Route::put('/mission-visions/{id}', [MissionVisionController::class, 'update'])->name('mission-visions.update');
            Route::patch('/mission-visions/{id}/toggle-status', [MissionVisionController::class, 'toggleStatus'])->name('mission-visions.toggle-status');
            Route::delete('/mission-visions/{id}', [MissionVisionController::class, 'destroy'])->name('mission-visions.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Notices
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:notices.view,notices.manage')->group(function () {
            Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
            Route::get('/notices/create', [NoticeController::class, 'create'])->name('notices.create')->middleware('permission:notices.manage');
            Route::post('/notices', [NoticeController::class, 'store'])->name('notices.store')->middleware('permission:notices.manage');
            Route::get('/notices/{id}/edit', [NoticeController::class, 'edit'])->name('notices.edit')->middleware('permission:notices.manage');
            Route::put('/notices/{id}', [NoticeController::class, 'update'])->name('notices.update')->middleware('permission:notices.manage');
            Route::patch('/notices/{id}/toggle-status', [NoticeController::class, 'toggleStatus'])->name('notices.toggle-status')->middleware('permission:notices.manage');
            Route::delete('/notices/{id}', [NoticeController::class, 'destroy'])->name('notices.destroy')->middleware('permission:notices.manage');
        });

        /*
        |--------------------------------------------------------------------------
        | Sliders
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:sliders.manage')->group(function () {
            Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
            Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
            Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');
            Route::get('/sliders/{id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
            Route::put('/sliders/{id}', [SliderController::class, 'update'])->name('sliders.update');
            Route::delete('/sliders/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
            Route::patch('/sliders/{id}/toggle-status', [SliderController::class, 'toggleStatus'])->name('sliders.toggle-status');
        });

        /*
        |--------------------------------------------------------------------------
        | Administrations
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:administration.manage')->group(function () {
            Route::get('/administrations', [AdministrationController::class, 'index'])->name('administrations.index');
            Route::get('/administrations/create', [AdministrationController::class, 'create'])->name('administrations.create');
            Route::post('/administrations', [AdministrationController::class, 'store'])->name('administrations.store');
            Route::get('/administrations/{id}/edit', [AdministrationController::class, 'edit'])->name('administrations.edit');
            Route::put('/administrations/{id}', [AdministrationController::class, 'update'])->name('administrations.update');
            Route::patch('/administrations/{id}/toggle-status', [AdministrationController::class, 'toggleStatus'])->name('administrations.toggle-status');
            Route::delete('/administrations/{id}', [AdministrationController::class, 'destroy'])->name('administrations.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Teachers
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:teachers.manage')->group(function () {
            Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
            Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
            Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
            Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
            Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
            Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | News & Events
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:news_events.manage')->group(function () {
            Route::get('/news', [NewsController::class, 'index'])->name('news.index');
            Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/news', [NewsController::class, 'store'])->name('news.store');
            Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
            Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

            Route::get('/events', [EventController::class, 'index'])->name('events.index');
            Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
            Route::post('/events', [EventController::class, 'store'])->name('events.store');
            Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
            Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
            Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Photo & Video Galleries
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:galleries.manage')->group(function () {
            Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
            Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
            Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
            Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
            Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
            Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

            Route::get('/video-galleries', [VideoGalleryController::class, 'index'])->name('video-galleries.index');
            Route::get('/video-galleries/create', [VideoGalleryController::class, 'create'])->name('video-galleries.create');
            Route::post('/video-galleries', [VideoGalleryController::class, 'store'])->name('video-galleries.store');
            Route::get('/video-galleries/{id}/edit', [VideoGalleryController::class, 'edit'])->name('video-galleries.edit');
            Route::put('/video-galleries/{id}', [VideoGalleryController::class, 'update'])->name('video-galleries.update');
            Route::patch('/video-galleries/{id}/toggle-status', [VideoGalleryController::class, 'toggleStatus'])->name('video-galleries.toggle-status');
            Route::delete('/video-galleries/{id}', [VideoGalleryController::class, 'destroy'])->name('video-galleries.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Admissions Hub (Circulars, Applications, Lottery, Payments)
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:admissions.circulars')->group(function () {
            Route::get('/admissions', [AdmissionController::class, 'index'])->name('admissions.index');
            Route::get('/admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
            Route::post('/admissions', [AdmissionController::class, 'store'])->name('admissions.store');
            Route::get('/admissions/{admission}/edit', [AdmissionController::class, 'edit'])->name('admissions.edit');
            Route::put('/admissions/{admission}', [AdmissionController::class, 'update'])->name('admissions.update');
            Route::delete('/admissions/{admission}', [AdmissionController::class, 'destroy'])->name('admissions.destroy');
        });

        Route::middleware('permission:admissions.applications')->group(function () {
            Route::get('/admission-applications', [AdmissionApplicationController::class,'index'])->name('admission-applications.index');
            Route::get('/admission-applications/{admissionApplication}', [AdmissionApplicationController::class,'show'])->name('admission-applications.show');
            Route::put('/admission-applications/{admissionApplication}/status', [AdmissionApplicationController::class,'updateStatus'])->name('admission-applications.status');
            Route::delete('/admission-applications/{admissionApplication}', [AdmissionApplicationController::class,'destroy'])->name('admission-applications.destroy');
        });

        Route::middleware('permission:admissions.lottery')->group(function () {
            Route::get('/admission-lottery', [AdmissionApplicationController::class, 'lotteryIndex'])->name('admission-lottery.index');
            Route::post('/admission-lottery/draw', [AdmissionApplicationController::class, 'lotteryDraw'])->name('admission-lottery.draw');
            Route::post('/admission-lottery/reset', [AdmissionApplicationController::class, 'lotteryReset'])->name('admission-lottery.reset');
            Route::post('/admission-lottery/confirm/{admissionApplication}', [AdmissionApplicationController::class, 'lotteryConfirm'])->name('admission-lottery.confirm');
        });

        Route::middleware('permission:admissions.payments')->group(function () {
            Route::get(
                '/admission-payments',
                [AdmissionPaymentController::class, 'index']
            )->name('admission-payments.index');

            Route::get(
                '/admission-payments/{admissionPayment}',
                [AdmissionPaymentController::class, 'show']
            )->name('admission-payments.show');

            Route::put(
                '/admission-payments/{admissionPayment}/status',
                [AdmissionPaymentController::class, 'updateStatus']
            )->name('admission-payments.status');

            Route::delete(
                '/admission-payments/{admissionPayment}',
                [AdmissionPaymentController::class, 'destroy']
            )->name('admission-payments.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Contact Messages
        |--------------------------------------------------------------------------
        */
        Route::middleware('permission:contact_messages.view,contact_messages.manage')->group(function () {
            Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
            Route::get('/contact-messages/{id}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
            Route::patch('/contact-messages/{id}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('contact-messages.toggle-read')->middleware('permission:contact_messages.manage');
            Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy')->middleware('permission:contact_messages.manage');
        });

        /*
        |--------------------------------------------------------------------------
        | Academic Hub (Syllabuses, Routines, Subjects, Results, Students)
        |--------------------------------------------------------------------------
        */
        // Syllabuses
        Route::middleware('permission:academic.syllabuses')->group(function () {
            Route::get('/syllabuses', [AcademicSyllabusController::class, 'index'])->name('syllabuses.index');
            Route::get('/syllabuses/create', [AcademicSyllabusController::class, 'create'])->name('syllabuses.create');
            Route::post('/syllabuses', [AcademicSyllabusController::class, 'store'])->name('syllabuses.store');
            Route::get('/syllabuses/{id}/edit', [AcademicSyllabusController::class, 'edit'])->name('syllabuses.edit');
            Route::put('/syllabuses/{id}', [AcademicSyllabusController::class, 'update'])->name('syllabuses.update');
            Route::patch('/syllabuses/{id}/toggle-status', [AcademicSyllabusController::class, 'toggleStatus'])->name('syllabuses.toggle-status');
            Route::delete('/syllabuses/{id}', [AcademicSyllabusController::class, 'destroy'])->name('syllabuses.destroy');
        });

        // Routines (Class & Exam)
        Route::middleware('permission:academic.routines')->group(function () {
            Route::get('/class-routines', [ClassRoutineController::class, 'index'])->name('class-routines.index');
            Route::get('/class-routines/create', [ClassRoutineController::class, 'create'])->name('class-routines.create');
            Route::post('/class-routines', [ClassRoutineController::class, 'store'])->name('class-routines.store');
            Route::get('/class-routines/{id}/edit', [ClassRoutineController::class, 'edit'])->name('class-routines.edit');
            Route::put('/class-routines/{id}', [ClassRoutineController::class, 'update'])->name('class-routines.update');
            Route::patch('/class-routines/{id}/toggle-status', [ClassRoutineController::class, 'toggleStatus'])->name('class-routines.toggle-status');
            Route::delete('/class-routines/{id}', [ClassRoutineController::class, 'destroy'])->name('class-routines.destroy');

            Route::get('/exam-routines', [ExamRoutineController::class, 'index'])->name('exam-routines.index');
            Route::get('/exam-routines/create', [ExamRoutineController::class, 'create'])->name('exam-routines.create');
            Route::post('/exam-routines', [ExamRoutineController::class, 'store'])->name('exam-routines.store');
            Route::get('/exam-routines/{id}/edit', [ExamRoutineController::class, 'edit'])->name('exam-routines.edit');
            Route::put('/exam-routines/{id}', [ExamRoutineController::class, 'update'])->name('exam-routines.update');
            Route::patch('/exam-routines/{id}/toggle-status', [ExamRoutineController::class, 'toggleStatus'])->name('exam-routines.toggle-status');
            Route::delete('/exam-routines/{id}', [ExamRoutineController::class, 'destroy'])->name('exam-routines.destroy');
        });

        // Academic Subjects
        Route::middleware('permission:academic.subjects')->group(function () {
            Route::get('/subjects', [AcademicSubjectController::class, 'index'])->name('subjects.index');
            Route::get('/subjects/create', [AcademicSubjectController::class, 'create'])->name('subjects.create');
            Route::post('/subjects', [AcademicSubjectController::class, 'store'])->name('subjects.store');
            Route::get('/subjects/{id}/edit', [AcademicSubjectController::class, 'edit'])->name('subjects.edit');
            Route::put('/subjects/{id}', [AcademicSubjectController::class, 'update'])->name('subjects.update');
            Route::patch('/subjects/{id}/toggle-status', [AcademicSubjectController::class, 'toggleStatus'])->name('subjects.toggle-status');
            Route::delete('/subjects/{id}', [AcademicSubjectController::class, 'destroy'])->name('subjects.destroy');
        });

        // Exam Results & Student Marks
        Route::middleware('permission:academic.results')->group(function () {
            Route::get('/exam-results', [ExamResultController::class, 'index'])->name('exam-results.index');
            Route::get('/exam-results/create', [ExamResultController::class, 'create'])->name('exam-results.create');
            Route::post('/exam-results', [ExamResultController::class, 'store'])->name('exam-results.store');
            Route::get('/exam-results/{id}/edit', [ExamResultController::class, 'edit'])->name('exam-results.edit');
            Route::put('/exam-results/{id}', [ExamResultController::class, 'update'])->name('exam-results.update');
            Route::patch('/exam-results/{id}/toggle-status', [ExamResultController::class, 'toggleStatus'])->name('exam-results.toggle-status');
            Route::delete('/exam-results/{id}', [ExamResultController::class, 'destroy'])->name('exam-results.destroy');

            Route::get('/student-marks', [StudentMarkController::class, 'index'])->name('student-marks.index');
            Route::get('/student-marks/create', [StudentMarkController::class, 'create'])->name('student-marks.create');
            Route::post('/student-marks', [StudentMarkController::class, 'store'])->name('student-marks.store');
            Route::get('/student-marks/{id}/edit', [StudentMarkController::class, 'edit'])->name('student-marks.edit');
            Route::put('/student-marks/{id}', [StudentMarkController::class, 'update'])->name('student-marks.update');
            Route::delete('/student-marks/{id}', [StudentMarkController::class, 'destroy'])->name('student-marks.destroy');
        });

        // Enrolled Students
        Route::middleware('permission:academic.students')->group(function () {
            Route::get('/students', [StudentController::class, 'index'])->name('students.index');
            Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
            Route::post('/students', [StudentController::class, 'store'])->name('students.store');
            Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
            Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
            Route::patch('/students/{id}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggle-status');
            Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
        });

        // Publications & Magazines
        Route::middleware('permission:publications.manage')->group(function () {
            Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
            Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
            Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
            Route::get('/publications/{id}/edit', [PublicationController::class, 'edit'])->name('publications.edit');
            Route::put('/publications/{id}', [PublicationController::class, 'update'])->name('publications.update');
            Route::patch('/publications/{id}/toggle-status', [PublicationController::class, 'toggleStatus'])->name('publications.toggle-status');
            Route::delete('/publications/{id}', [PublicationController::class, 'destroy'])->name('publications.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Roles & Permissions Management (RBAC) - Super Admin Only
        |--------------------------------------------------------------------------
        */
        Route::middleware('role:super-admin')->group(function () {
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | Users Management - Super Admin Only
        |--------------------------------------------------------------------------
        */
        Route::middleware('role:super-admin')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
            Route::patch('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
            Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';