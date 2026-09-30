<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\AdmissionApplicationController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=== TESTING PAGE RENDERS ===\n";

$frontend = app(FrontendController::class);
$admin = app(AdmissionApplicationController::class);

view()->share('errors', new \Illuminate\Support\ViewErrorBag());

$adminUser = User::first();
if ($adminUser) {
    Auth::login($adminUser);
}

$routes = [
    'Home' => fn() => $frontend->home(),
    'About' => fn() => $frontend->about(),
    'Notice' => fn() => $frontend->notice(),
    'Teachers' => fn() => $frontend->teachers(),
    'Online Admission Form' => fn() => $frontend->onlineAdmission(),
    'Online Admission Download' => fn() => $frontend->admissionDownload(Request::create('/online-admission/download')),
    'Public Lottery Results' => fn() => $frontend->lotteryResult(Request::create('/admission/lottery-result')),
    'Admission Fee' => fn() => $frontend->admissionFee(Request::create('/admission-fee')),
    'Admin Applications Index' => fn() => $admin->index(Request::create('/admin/admission-applications')),
    'Admin Lottery Index' => fn() => $admin->lotteryIndex(Request::create('/admin/admission-lottery')),
];

foreach ($routes as $name => $fn) {
    try {
        $view = $fn();
        if (is_a($view, \Illuminate\View\View::class)) {
            $html = $view->render();
            echo "[OK] {$name} rendered successfully (Length: " . strlen($html) . " bytes)\n";
        } else {
            echo "[RESPONSE] {$name} returned " . get_class($view) . "\n";
        }
    } catch (\Throwable $e) {
        echo "[ERROR] {$name}: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\n";
    }
}

echo "=== RENDER TESTING FINISHED ===\n";
