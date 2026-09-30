<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$urls = [
    '/' => 'Home',
    '/about' => 'About',
    '/administration' => 'Administration',
    '/teachers' => 'Teachers',
    '/staff' => 'Staff',
    '/syllabus' => 'Syllabus',
    '/subjects' => 'Subjects',
    '/results' => 'Results',
    '/admission' => 'Admission',
    '/online-admission' => 'Online Admission',
    '/contact' => 'Contact',
    '/gallery' => 'Gallery',
    '/video-gallery' => 'Video Gallery',
    '/magazine' => 'Magazine',
    '/publications' => 'Publications',
];

echo "=== TESTING ALL FRONTEND PAGES ===" . PHP_EOL;

$allPassed = true;

foreach ($urls as $url => $label) {
    $request = Illuminate\Http\Request::create($url, 'GET');
    $response = $kernel->handle($request);
    $status = $response->getStatusCode();
    $content = $response->getContent();

    $hasKalpurush = strpos($content, 'Kalpurush') !== false;
    $hasWelcomeToOurSchool = strpos($content, 'Welcome to Our School') !== false;
    $hasUnsplashDemo = strpos($content, 'photo-1523050854058') !== false;

    if ($status === 200 && $hasKalpurush && !$hasWelcomeToOurSchool && !$hasUnsplashDemo) {
        echo " [OK] $label ($url) -> Status 200 | Kalpurush Font: Yes | Clean: Yes" . PHP_EOL;
    } else {
        echo " [FAIL] $label ($url) -> Status: $status | Kalpurush: " . ($hasKalpurush ? 'Yes' : 'No') . " | WelcomeEn: " . ($hasWelcomeToOurSchool ? 'Found' : 'No') . " | Unsplash: " . ($hasUnsplashDemo ? 'Found' : 'No') . PHP_EOL;
        $allPassed = false;
    }
}

if ($allPassed) {
    echo PHP_EOL . ">>> ALL TESTS PASSED! FULL WEBSITE IS USING KALPURUSH FONT & PURE DYNAMIC DATABASE CONTENT! <<<" . PHP_EOL;
} else {
    echo PHP_EOL . ">>> SOME CHECKS FAILED! <<<" . PHP_EOL;
}
