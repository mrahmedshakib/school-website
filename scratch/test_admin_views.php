<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\AcademicSyllabus;
use App\Models\ClassRoutine;
use App\Models\ExamRoutine;
use App\Models\AcademicSubject;
use App\Models\ExamResult;
use App\Models\StudentMark;
use App\Models\Student;
use App\Models\SchoolPublication;
use App\Models\VideoGallery;
use App\Models\Notice;
use App\Models\Teacher;

// Ensure admin user exists or simulate authentication
$admin = User::first();
if (!$admin) {
    $admin = new User();
    $admin->id = 1;
    $admin->name = 'Admin';
    $admin->email = 'admin@admin.com';
}
auth()->login($admin);

$routesToTest = [
    // Syllabuses
    ['name' => 'admin.syllabuses.index', 'params' => []],
    ['name' => 'admin.syllabuses.create', 'params' => []],
    ['name' => 'admin.syllabuses.edit', 'params' => ['id' => AcademicSyllabus::first()?->id]],

    // Class Routines
    ['name' => 'admin.class-routines.index', 'params' => []],
    ['name' => 'admin.class-routines.create', 'params' => []],
    ['name' => 'admin.class-routines.edit', 'params' => ['id' => ClassRoutine::first()?->id]],

    // Exam Routines
    ['name' => 'admin.exam-routines.index', 'params' => []],
    ['name' => 'admin.exam-routines.create', 'params' => []],
    ['name' => 'admin.exam-routines.edit', 'params' => ['id' => ExamRoutine::first()?->id]],

    // Academic Subjects
    ['name' => 'admin.subjects.index', 'params' => []],
    ['name' => 'admin.subjects.create', 'params' => []],
    ['name' => 'admin.subjects.edit', 'params' => ['id' => AcademicSubject::first()?->id]],

    // Exam Results
    ['name' => 'admin.exam-results.index', 'params' => []],
    ['name' => 'admin.exam-results.create', 'params' => []],
    ['name' => 'admin.exam-results.edit', 'params' => ['id' => ExamResult::first()?->id]],

    // Student Marks
    ['name' => 'admin.student-marks.index', 'params' => []],
    ['name' => 'admin.student-marks.create', 'params' => []],
    ['name' => 'admin.student-marks.edit', 'params' => ['id' => StudentMark::first()?->id]],

    // Students
    ['name' => 'admin.students.index', 'params' => []],
    ['name' => 'admin.students.create', 'params' => []],
    ['name' => 'admin.students.edit', 'params' => ['id' => Student::first()?->id]],

    // Publications
    ['name' => 'admin.publications.index', 'params' => []],
    ['name' => 'admin.publications.create', 'params' => []],
    ['name' => 'admin.publications.edit', 'params' => ['id' => SchoolPublication::first()?->id]],

    // Video Galleries
    ['name' => 'admin.video-galleries.index', 'params' => []],
    ['name' => 'admin.video-galleries.create', 'params' => []],
    ['name' => 'admin.video-galleries.edit', 'params' => ['id' => VideoGallery::first()?->id]],

    // Notices
    ['name' => 'admin.notices.index', 'params' => []],
    ['name' => 'admin.notices.create', 'params' => []],
    ['name' => 'admin.notices.edit', 'params' => ['id' => Notice::first()?->id]],

    // Teachers
    ['name' => 'admin.teachers.index', 'params' => []],
    ['name' => 'admin.teachers.create', 'params' => []],
    ['name' => 'admin.teachers.edit', 'params' => ['teacher' => Teacher::first()?->id]],
];

$errors = [];
$successCount = 0;

foreach ($routesToTest as $r) {
    $routeName = $r['name'];
    $params = $r['params'];

    // Skip edit if no model found
    if (str_contains($routeName, '.edit') && empty(reset($params))) {
        echo "SKIPPED: $routeName (no model instance found to edit)\n";
        continue;
    }

    try {
        $fullUrl = route($routeName, $params);
        $path = parse_url($fullUrl, PHP_URL_PATH);
        
        $subRequest = Illuminate\Http\Request::create($path, 'GET');
        $subRequest->setUserResolver(fn() => $admin);
        
        $subResponse = $kernel->handle($subRequest);
        $status = $subResponse->getStatusCode();
        
        if ($status === 200) {
            echo "PASS (200): $routeName -> $path\n";
            $successCount++;
        } else {
            echo "FAIL ($status): $routeName -> $path\n";
            $errors[] = "$routeName returned $status";
        }
        $kernel->terminate($subRequest, $subResponse);
    } catch (\Throwable $e) {
        echo "EXCEPTION on $routeName: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "\n";
        $errors[] = "$routeName threw: " . $e->getMessage();
    }
}

echo "\n============================================\n";
echo "Total Passed: $successCount / " . count($routesToTest) . "\n";
if (!empty($errors)) {
    echo "Failures:\n" . implode("\n", $errors) . "\n";
} else {
    echo "ALL ADMIN MODULE ROUTES RENDERED PERFECTLY!\n";
}
echo "============================================\n";
