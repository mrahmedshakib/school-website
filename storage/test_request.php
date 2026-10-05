<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$management = App\Models\User::where('email', 'management@gmail.com')->first();
auth()->login($management);

$request = Illuminate\Http\Request::create('/admin/users', 'GET');
$request->setUserResolver(function () use ($management) {
    return $management;
});

try {
    $response = $kernel->handle($request);
    echo "/admin/users status code: " . $response->getStatusCode() . PHP_EOL;
} catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
    echo "/admin/users HTTP exception: " . $e->getStatusCode() . " " . $e->getMessage() . PHP_EOL;
} catch (\Throwable $e) {
    echo "/admin/users error: " . $e->getMessage() . PHP_EOL;
}
