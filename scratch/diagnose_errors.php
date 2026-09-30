<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$controller = new App\Http\Controllers\Frontend\FrontendController;

echo "1. Subjects:\n";
try {
    $res = $controller->subjects(request());
    echo "Render: " . substr($res->render(), 0, 100) . "\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "2. Result:\n";
try {
    request()->merge(['class' => 'Class 10', 'roll_no' => '101', 'exam_name' => 'Annual Examination 2025']);
    $res = $controller->result(request());
    echo "Render: " . substr($res->render(), 0, 100) . "\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\n";
}

echo "3. Video Gallery:\n";
try {
    $res = $controller->videoGallery();
    echo "Render: " . substr($res->render(), 0, 100) . "\n";
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\n";
}
