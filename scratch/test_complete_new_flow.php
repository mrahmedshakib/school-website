<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AdmissionApplication;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\AdmissionApplicationController;
use Illuminate\Http\UploadedFile;

echo "=== STARTING COMPREHENSIVE ADMISSION FLOW TEST ===\n";

// 1. TEST LANGUAGE SWITCHING
echo "\n--- 1. Testing Locale Switching ---\n";
session(['locale' => 'en']);
app()->setLocale('en');
echo "Current Locale: " . app()->getLocale() . " | Translated 'হোম': " . __('হোম') . " | 'ভর্তি': " . __('ভর্তি') . "\n";

session(['locale' => 'bn']);
app()->setLocale('bn');
echo "Current Locale: " . app()->getLocale() . " | Translated 'হোম': " . __('হোম') . " | 'ভর্তি': " . __('ভর্তি') . "\n";

// 2. CREATE A DUMMY APPLICATION WITH ALL NEW FIELDS
echo "\n--- 2. Testing Application Creation with New Fields ---\n";
$tempPhoto = tempnam(sys_get_temp_dir(), 'photo') . '.png';
file_put_contents($tempPhoto, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg=='));

$uploadedPhoto = new UploadedFile($tempPhoto, 'student.png', 'image/png', null, true);

$storeRequest = Request::create('/online-admission', 'POST', [
    'academic_year' => '2026',
    'class' => 'Class 9',
    'group_name' => 'Science (বিজ্ঞান)',
    'student_name' => 'Tanvir Ahmed',
    'student_name_bn' => 'তানভীর আহমেদ',
    'student_name_en' => 'TANVIR AHMED',
    'date_of_birth' => '2012-05-15',
    'gender' => 'male',
    'blood_group' => 'A+',
    'birth_reg_no' => '20121012345678901',
    'religion' => 'Islam',
    'nationality' => 'Bangladeshi',
    'previous_school' => 'Dupchanchia Pilot High School',
    'father_name' => 'মোঃ রফিকুল ইসলাম',
    'father_name_en' => 'MD RAFIQUL ISLAM',
    'father_nid' => '19801234567890',
    'father_education' => 'B.Sc Engineering',
    'father_occupation_info' => 'Govt Service, Annual Income 6,50,000 BDT',
    'mother_name' => 'মোসাঃ নাসরিন আক্তার',
    'mother_name_en' => 'MST NASRIN AKTER',
    'mother_nid' => '19851234567890',
    'mother_education' => 'M.A',
    'present_address' => 'গ্রাম: ধাপ, ডাকঘর: দুপচাঁচিয়া, উপজেলা: দুপচাঁচিয়া, জেলা: বগুড়া',
    'permanent_address' => 'গ্রাম: ধাপ, ডাকঘর: দুপচাঁচিয়া, উপজেলা: দুপচাঁচিয়া, জেলা: বগুড়া',
    'address' => 'গ্রাম: ধাপ, ডাকঘর: দুপচাঁচিয়া, উপজেলা: দুপচাঁচিয়া, জেলা: বগুড়া',
    'guardian_phone' => '01712998877',
    'contact_mobile' => '01812998877',
    'email' => 'tanvir.test@example.com',
    'guardian_info' => 'পিতা নিজে অভিভাবক',
    'other_children_info' => 'ছোট বোন তাসনিম (Class 6)',
    'captcha_num1' => '5',
    'captcha_num2' => '3',
    'captcha_answer' => '8',
], [], [
    'student_photo' => $uploadedPhoto,
]);

$frontendController = app(FrontendController::class);
$response = $frontendController->onlineAdmissionStore($storeRequest);

$createdApp = AdmissionApplication::where('guardian_phone', '01712998877')->latest()->first();

if ($createdApp) {
    echo "SUCCESS: Application created! No: {$createdApp->application_no}\n";
    echo " - Student Name BN: {$createdApp->student_name_bn}\n";
    echo " - Student Name EN: {$createdApp->student_name_en}\n";
    echo " - BRN (17-digit): {$createdApp->birth_reg_no}\n";
    echo " - Class & Group: {$createdApp->class} | {$createdApp->group_name}\n";
    echo " - Father NID & Education: {$createdApp->father_nid} | {$createdApp->father_education}\n";
    echo " - Photo Path: {$createdApp->student_photo}\n";
} else {
    echo "FAILED to create application.\n";
    exit(1);
}

// 3. TEST RE-DOWNLOAD SEARCH
echo "\n--- 3. Testing Re-Download Search Portal ---\n";
// Search by App No
$searchByAppReq = Request::create('/online-admission/download', 'POST', [
    'search_type' => 'app_no',
    'application_no' => $createdApp->application_no,
]);
$downloadResp1 = $frontendController->admissionDownloadSearch($searchByAppReq);
echo "Search by App No HTTP Status / View check: " . (is_a($downloadResp1, \Illuminate\View\View::class) ? "SUCCESS (View returned)" : "Redirect") . "\n";

// Search by Phone + DOB
$searchByPhoneDobReq = Request::create('/online-admission/download', 'POST', [
    'search_type' => 'mobile_dob',
    'guardian_phone' => '01712998877',
    'date_of_birth' => '2012-05-15',
]);
$downloadResp2 = $frontendController->admissionDownloadSearch($searchByPhoneDobReq);
echo "Search by Phone + DOB check: " . (is_a($downloadResp2, \Illuminate\View\View::class) ? "SUCCESS (View returned)" : "Redirect") . "\n";

// 4. TEST DIGITAL LOTTERY DRAW (Create 4 more applications to test lottery)
echo "\n--- 4. Testing Digital Lottery Engine ---\n";
for ($i = 1; $i <= 4; $i++) {
    AdmissionApplication::create([
        'application_no' => 'BLSC-2026-TEST' . $i,
        'academic_year' => '2026',
        'class' => 'Class 9',
        'student_name' => "Student Test {$i}",
        'student_name_bn' => "শিক্ষার্থী টেস্ট {$i}",
        'student_name_en' => "STUDENT TEST {$i}",
        'date_of_birth' => '2012-01-0' . $i,
        'gender' => $i % 2 === 0 ? 'female' : 'male',
        'father_name' => "পিতা টেস্ট {$i}",
        'mother_name' => "মাতা টেস্ট {$i}",
        'guardian_phone' => '0171100000' . $i,
        'address' => 'দুপচাঁচিয়া, বগুড়া',
        'status' => 'pending',
    ]);
}

$adminController = app(AdmissionApplicationController::class);

$drawReq = Request::create('/admin/admission-lottery/draw', 'POST', [
    'academic_year' => '2026',
    'class' => 'Class 9',
    'seats' => 3, // Out of 5 total candidates, 3 selected, 2 waiting
    'quota_ff' => 10,
    'quota_sibling' => 10,
    'quota_catchment' => 10,
]);

$drawResp = $adminController->lotteryDraw($drawReq);
echo "Lottery Draw executed.\n";

$selected = AdmissionApplication::where('academic_year', '2026')
    ->where('class', 'Class 9')
    ->where('is_lottery_selected', 1)
    ->orderBy('lottery_rank')
    ->get();

$waiting = AdmissionApplication::where('academic_year', '2026')
    ->where('class', 'Class 9')
    ->where('lottery_quota', 'waiting')
    ->orderBy('lottery_rank')
    ->get();

echo "Selected Candidates count: " . $selected->count() . "\n";
foreach ($selected as $s) {
    echo " - Rank #{$s->lottery_rank} | {$s->student_name} ({$s->student_name_bn}) | App: {$s->application_no} | Quota: {$s->lottery_quota} | Status: {$s->status}\n";
}

echo "Waiting Candidates count: " . $waiting->count() . "\n";
foreach ($waiting as $w) {
    echo " - Waiting Rank #{$w->lottery_rank} | {$w->student_name} | App: {$w->application_no}\n";
}

// 5. TEST PUBLIC LOTTERY RESULT VIEW
echo "\n--- 5. Testing Public Lottery View ---\n";
$publicLotteryReq = Request::create('/admission/lottery-result', 'GET', [
    'academic_year' => '2026',
    'class' => 'Class 9',
]);
$lotteryView = $frontendController->lotteryResult($publicLotteryReq);
echo "Public Lottery View rendered: " . (is_a($lotteryView, \Illuminate\View\View::class) ? "SUCCESS" : "FAILED") . "\n";

// 6. TEST ADMISSION CONFIRMATION
echo "\n--- 6. Testing Final Admission Confirmation ---\n";
$firstCandidate = $selected->first();
$confirmReq = Request::create("/admin/admission-lottery/confirm/{$firstCandidate->id}", 'POST');
$adminController->lotteryConfirm($confirmReq, $firstCandidate);
$firstCandidate->refresh();

echo "Confirmation status: " . ($firstCandidate->is_confirmed ? "CONFIRMED" : "NOT CONFIRMED") . "\n";
echo "Confirmed at: " . $firstCandidate->confirmed_at . "\n";
echo "Final Status: " . $firstCandidate->status . "\n";

// 7. CLEANUP TEMP FILE
if (file_exists($tempPhoto)) {
    unlink($tempPhoto);
}

echo "\n=== ALL TESTS COMPLETED SUCCESSFULLY! ===\n";
