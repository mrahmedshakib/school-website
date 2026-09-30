<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;

$routes = [
    '/',
    '/notice',
    '/syllabus',
    '/class-routine',
    '/exam-routine',
    '/subjects',
    '/results',
    '/result?class=Class+10&roll_no=101&exam_name=Annual+Examination+2025',
    '/teachers',
    '/staff',
    '/students',
    '/student-list',
    '/magazine',
    '/publications',
    '/video-gallery',
];

$results = [];

foreach (['bn', 'en'] as $lang) {
    app()->setLocale($lang);
    foreach ($routes as $route) {
        $uri = strtok($route, '?');
        $queryString = parse_url($route, PHP_URL_QUERY);
        parse_str($queryString ?? '', $params);

        $request = Request::create($route, 'GET', $params);
        $request->setLaravelSession(app('session.store'));
        
        try {
            $response = $app->handle($request);
            $status = $response->getStatusCode();
            $results[] = "[{$lang}] {$route} -> HTTP {$status}";
        } catch (\Throwable $e) {
            $results[] = "[{$lang}] {$route} -> ERROR: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine();
        }
    }
}

echo implode("\n", $results);
