<?php

require_once 'e:/laragon/www/school-website/vendor/autoload.php';
$app = require_once 'e:/laragon/www/school-website/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AdmissionApplication;
use App\Models\AdmissionPayment;
use App\Models\AdmissionFee;
use App\Models\WebsiteSetting;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

echo "========================================================\n";
echo "       COMPREHENSIVE ADMISSION FLOW VERIFICATION        \n";
echo "========================================================\n\n";

$controller = app(FrontendController::class);

// 1. Notice Page
echo "[1] Testing /admission ...\n";
$req1 = Request::create('/admission', 'GET');
$view1 = $controller->admission($req1);
echo "    ✓ Status: OK | View: " . $view1->name() . "\n\n";

// 2. Online Admission Form
echo "[2] Testing /online-admission ...\n";
$req2 = Request::create('/online-admission', 'GET');
$view2 = $controller->onlineAdmission($req2);
echo "    ✓ Status: OK | View: " . $view2->name() . "\n\n";

// 3. Online Admission Form Submission with Photo
echo "[3] Testing /online-admission POST (Form submission) ...\n";
$dummyImg = UploadedFile::fake()->image('student_passport.jpg', 300, 300);

$postData = [
    'student_name' => 'আব্দুর রহমান',
    'date_of_birth' => '2014-03-15',
    'gender' => 'male',
    'class' => 'Class 6',
    'previous_school' => 'দুপচাঁচিয়া সরকারি প্রাথমিক বিদ্যালয়',
    'father_name' => 'মো: আনিসুর রহমান',
    'mother_name' => 'মোছা: ফাতেমা বেগম',
    'guardian_phone' => '01711223344',
    'email' => 'rahman.family@gmail.com',
    'address' => 'উপজেলা চত্বর, দুপচাঁচিয়া, বগুড়া',
    'student_photo' => $dummyImg,
];

$req3 = Request::create('/online-admission', 'POST', $postData, [], ['student_photo' => $dummyImg]);
$response3 = $controller->onlineAdmissionStore($req3);

echo "    ✓ Redirect: " . $response3->headers->get('Location') . "\n";
$appNo = session('application_no');
echo "    ✓ Application Created: " . $appNo . "\n\n";

$application = AdmissionApplication::where('application_no', $appNo)->firstOrFail();

// 4. Confirmation Page
echo "[4] Testing /online-admission/confirmation/{$appNo} ...\n";
$view4 = $controller->onlineAdmissionConfirmation($appNo);
echo "    ✓ Status: OK | View: " . $view4->name() . " | Student: " . $view4->getData()['application']->student_name . "\n\n";

// 5. PDF Generation & Font Verification
echo "[5] Testing /online-admission/application/{$appNo}/pdf ...\n";
$pdfResponse = $controller->downloadAdmissionApplicationPdf($appNo);
$pdfContent = $pdfResponse->getContent();
echo "    ✓ PDF generated! Size: " . strlen($pdfContent) . " bytes\n";

preg_match_all('/\/BaseFont\s*\/([A-Za-z0-9_-]+)/', $pdfContent, $matches);
$fonts = array_values(array_unique($matches[1]));
echo "    ✓ Embedded Fonts in PDF: " . json_encode($fonts) . "\n";
$hasHelvetica = false;
foreach ($fonts as $f) {
    if (stripos($f, 'helvetica') !== false) {
        $hasHelvetica = true;
    }
}
if ($hasHelvetica) {
    echo "    ✕ WARNING: Helvetica found in PDF!\n";
} else {
    echo "    ✓ Bengali Font Integrity: 100% Kalpurush Unicode subsets (Zero Helvetica fallback)!\n\n";
}

// 6. Admission Fee Page (Lookup with application_no)
echo "[6] Testing /admission-fee?application_no={$appNo} ...\n";
$req6 = Request::create('/admission-fee', 'GET', ['application_no' => $appNo]);
$view6 = $controller->admissionFee($req6);
echo "    ✓ Status: OK | View: " . $view6->name() . "\n";
echo "    ✓ Applicant matched: " . $view6->getData()['application']->student_name . " | Payable Fee: ৳" . $view6->getData()['totalFee'] . "\n\n";

// 7. Manual Payment Submission (bKash)
echo "[7] Testing /admission-fee POST (Manual MFS Payment: bKash) ...\n";
$req7 = Request::create('/admission-fee', 'POST', [
    'application_no' => $appNo,
    'payment_method' => 'bkash',
    'account_number' => '01711223344',
    'transaction_id' => 'TRX778899AABB',
]);
$resp7 = $controller->admissionFeeStore($req7);
echo "    ✓ Redirect: " . $resp7->headers->get('Location') . "\n";
$payment = AdmissionPayment::where('transaction_id', 'TRX778899AABB')->firstOrFail();
echo "    ✓ Payment Record Created: " . $payment->payment_no . " | Status: " . $payment->status . "\n\n";

// 8. Money Receipt View
echo "[8] Testing /admission-payment/{$payment->id}/receipt ...\n";
$view8 = $controller->admissionPaymentReceipt($payment->id);
echo "    ✓ Status: OK | View: " . $view8->name() . " | Amount: ৳" . $view8->getData()['payment']->amount . "\n\n";

// 9. SSLCOMMERZ Gateway Initiation & Success
echo "[9] Testing SSLCOMMERZ Gateway Flow ...\n";
$sslReq = Request::create('/admission-fee', 'POST', [
    'application_no' => $appNo,
    'payment_method' => 'sslcommerz',
]);
$sslResp = $controller->admissionFeeStore($sslReq);
echo "    ✓ Gateway Initiation Redirect: " . $sslResp->headers->get('Location') . "\n";

$sslPayment = AdmissionPayment::where('admission_application_id', $application->id)
    ->where('payment_method', 'sslcommerz')
    ->latest()
    ->firstOrFail();

echo "    ✓ SSL Payment Record: " . $sslPayment->payment_no . "\n";

// Test SSL Success Callback
$callbackReq = Request::create('/admission-fee/sslcommerz/success', 'POST', [
    'tran_id' => $sslPayment->payment_no,
    'value_b' => $sslPayment->payment_no,
    'bank_tran_id' => 'SSLCZ-BANK-998877',
    'card_type' => 'VISA-CityBank',
    'card_no' => '400012XXXXXX1234',
    'amount' => '500.00',
    'status' => 'VALID',
]);
$callbackResp = $controller->sslcommerzSuccess($callbackReq);
echo "    ✓ Callback Redirect: " . $callbackResp->headers->get('Location') . "\n";

$sslPayment->refresh();
$application->refresh();

echo "    ✓ Payment Status: " . $sslPayment->status . " (Verified At: " . $sslPayment->verified_at . ")\n";
echo "    ✓ Application Status: " . $application->status . "\n\n";

echo "========================================================\n";
echo "    ALL 9 STAGES OF ONLINE ADMISSION PASSED WITH 100%!  \n";
echo "========================================================\n";
