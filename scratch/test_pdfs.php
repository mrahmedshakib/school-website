<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\AdmissionApplication;
use App\Http\Controllers\Frontend\FrontendController;

echo "=== TESTING PDF GENERATION (APP, ADMIT CARD, RECEIPT) ===\n";

$frontend = app(FrontendController::class);
$application = AdmissionApplication::with('payments')->latest()->first();

if (!$application) {
    echo "No application found to test PDF.\n";
    exit(1);
}

echo "Testing with Application No: {$application->application_no}\n";

// 1. Application PDF
try {
    $pdfResp = $frontend->downloadAdmissionApplicationPdf($application->application_no);
    $content = $pdfResp->getContent();
    echo "[OK] Application Form PDF generated: " . strlen($content) . " bytes\n";
    if (strpos($content, '%PDF') === 0) {
        echo " -> Verified valid PDF binary header!\n";
    }
} catch (\Throwable $e) {
    echo "[ERROR] Application PDF: " . $e->getMessage() . "\n";
}

// 2. Admit Card PDF
try {
    $admitResp = $frontend->downloadAdmissionAdmitCardPdf($application->application_no);
    $admitContent = $admitResp->getContent();
    echo "[OK] Admit Card PDF generated: " . strlen($admitContent) . " bytes\n";
    if (strpos($admitContent, '%PDF') === 0) {
        echo " -> Verified valid PDF binary header!\n";
    }
} catch (\Throwable $e) {
    echo "[ERROR] Admit Card PDF: " . $e->getMessage() . "\n";
}

// 3. Receipt PDF
try {
    $receiptResp = $frontend->downloadAdmissionReceiptPdf($application->application_no);
    $receiptContent = $receiptResp->getContent();
    echo "[OK] Receipt PDF generated: " . strlen($receiptContent) . " bytes\n";
    if (strpos($receiptContent, '%PDF') === 0) {
        echo " -> Verified valid PDF binary header!\n";
    }
} catch (\Throwable $e) {
    echo "[ERROR] Receipt PDF: " . $e->getMessage() . "\n";
}

echo "=== PDF TESTING FINISHED ===\n";
