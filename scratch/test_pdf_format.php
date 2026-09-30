<?php

require_once 'e:/laragon/www/school-website/vendor/autoload.php';
$app = require_once 'e:/laragon/www/school-website/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AdmissionApplication;
use App\Models\WebsiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;

$application = AdmissionApplication::first();
if (!$application) {
    $application = AdmissionApplication::create([
        'application_no' => 'BLSC-2026-TEST01',
        'student_name' => 'তামজিদ হাসান',
        'date_of_birth' => '2015-05-10',
        'gender' => 'male',
        'class' => 'Class 6',
        'previous_school' => 'দুপচাঁচিয়া মডেল সরকারি প্রাথমিক বিদ্যালয়',
        'father_name' => 'মো: রফিকুল ইসলাম',
        'mother_name' => 'মোছা: নাসরিন আক্তার',
        'guardian_phone' => '01712345678',
        'email' => 'tamjid.parent@gmail.com',
        'address' => 'উপজেলা রোড, দুপচাঁচিয়া, বগুড়া',
        'status' => 'pending',
    ]);
}

$websiteSetting = WebsiteSetting::first();

$fontPath = str_replace('\\', '/', public_path('fonts/Kalpurush/kalpurush.ttf'));

$pdf = Pdf::loadView('frontend.admission.application-pdf', compact('application', 'websiteSetting'));
$pdf->setPaper('A4', 'portrait');

$dompdf = $pdf->getDomPDF();
$fontMetrics = $dompdf->getFontMetrics();

$styles = ['normal', 'italic'];
$weights = ['normal', 'bold', 'bolder', '500', '600', '700', '800', '900'];
foreach ($styles as $style) {
    foreach ($weights as $weight) {
        $fontMetrics->registerFont(
            ['family' => 'Kalpurush', 'style' => $style, 'weight' => $weight],
            $fontPath
        );
    }
}

$output = $pdf->output();
$outFile = 'e:/laragon/www/school-website/public/test_application_rendered.pdf';
file_put_contents($outFile, $output);

echo "PDF successfully generated!\n";
echo "Output file: " . $outFile . " (" . strlen($output) . " bytes)\n";

preg_match_all('/\/BaseFont\s*\/([A-Za-z0-9_-]+)/', $output, $matches);
echo "Fonts embedded: " . json_encode(array_values(array_unique($matches[1]))) . "\n";
