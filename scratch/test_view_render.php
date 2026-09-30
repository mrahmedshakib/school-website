<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

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
use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

$request = Request::create('/', 'GET');
$app->instance('request', $request);
view()->share('errors', new ViewErrorBag());

$sampleClasses = collect(['Class 1', 'Class 2', 'Class 3', 'Class 4', 'Class 5', 'Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10']);
$sampleGroups = collect(['Science', 'Commerce', 'Humanities', 'General']);

$viewsToTest = [
    // Syllabuses
    ['view' => 'backend.syllabuses.index', 'data' => ['syllabuses' => AcademicSyllabus::paginate(10), 'classes' => $sampleClasses]],
    ['view' => 'backend.syllabuses.create', 'data' => []],
    ['view' => 'backend.syllabuses.edit', 'data' => ['syllabus' => AcademicSyllabus::first()]],

    // Class Routines
    ['view' => 'backend.class-routines.index', 'data' => ['routines' => ClassRoutine::paginate(10), 'classes' => $sampleClasses]],
    ['view' => 'backend.class-routines.create', 'data' => []],
    ['view' => 'backend.class-routines.edit', 'data' => ['routine' => ClassRoutine::first()]],

    // Exam Routines
    ['view' => 'backend.exam-routines.index', 'data' => ['examRoutines' => ExamRoutine::paginate(10), 'classes' => $sampleClasses]],
    ['view' => 'backend.exam-routines.create', 'data' => []],
    ['view' => 'backend.exam-routines.edit', 'data' => ['exam' => ExamRoutine::first()]],

    // Academic Subjects
    ['view' => 'backend.subjects.index', 'data' => ['subjects' => AcademicSubject::paginate(10), 'classes' => $sampleClasses, 'groups' => $sampleGroups]],
    ['view' => 'backend.subjects.create', 'data' => []],
    ['view' => 'backend.subjects.edit', 'data' => ['subject' => AcademicSubject::first()]],

    // Exam Results
    ['view' => 'backend.exam-results.index', 'data' => ['results' => ExamResult::paginate(10), 'classes' => $sampleClasses]],
    ['view' => 'backend.exam-results.create', 'data' => []],
    ['view' => 'backend.exam-results.edit', 'data' => ['result' => ExamResult::first()]],

    // Student Marks
    ['view' => 'backend.student-marks.index', 'data' => ['marks' => StudentMark::paginate(10), 'classes' => $sampleClasses]],
    ['view' => 'backend.student-marks.create', 'data' => []],
    ['view' => 'backend.student-marks.edit', 'data' => ['mark' => StudentMark::first()]],

    // Students
    ['view' => 'backend.students.index', 'data' => ['students' => Student::paginate(10), 'classes' => $sampleClasses]],
    ['view' => 'backend.students.create', 'data' => []],
    ['view' => 'backend.students.edit', 'data' => ['student' => Student::first()]],

    // Publications
    ['view' => 'backend.publications.index', 'data' => ['publications' => SchoolPublication::paginate(10)]],
    ['view' => 'backend.publications.create', 'data' => []],
    ['view' => 'backend.publications.edit', 'data' => ['publication' => SchoolPublication::first()]],

    // Video Galleries
    ['view' => 'backend.video-galleries.index', 'data' => ['videos' => VideoGallery::paginate(10)]],
    ['view' => 'backend.video-galleries.create', 'data' => []],
    ['view' => 'backend.video-galleries.edit', 'data' => ['video' => VideoGallery::first()]],

    // Notices
    ['view' => 'backend.notices.index', 'data' => ['notices' => Notice::paginate(10)]],
    ['view' => 'backend.notices.create', 'data' => []],
    ['view' => 'backend.notices.edit', 'data' => ['notice' => Notice::first()]],

    // Teachers
    ['view' => 'backend.teachers.index', 'data' => ['teachers' => Teacher::paginate(10)]],
    ['view' => 'backend.teachers.create', 'data' => []],
    ['view' => 'backend.teachers.edit', 'data' => ['teacher' => Teacher::first()]],
];

$errors = [];
$successCount = 0;

foreach ($viewsToTest as $item) {
    $vName = $item['view'];
    $data = $item['data'];

    try {
        $html = view($vName, $data)->render();
        if (strlen($html) > 0) {
            echo "PASS (View Rendered): $vName (" . strlen($html) . " bytes)\n";
            $successCount++;
        } else {
            echo "WARN: Empty render for $vName\n";
        }
    } catch (\Throwable $e) {
        echo "FAIL on $vName: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine() . "\n";
        $errors[] = "$vName failed: " . $e->getMessage();
    }
}

echo "\n============================================\n";
echo "Total Views Tested: " . count($viewsToTest) . "\n";
echo "Total Passed: $successCount / " . count($viewsToTest) . "\n";
if (!empty($errors)) {
    echo "Failures:\n" . implode("\n", $errors) . "\n";
} else {
    echo "ALL 33 ADMIN MODULE VIEWS RENDERED 100% PERFECTLY!\n";
}
echo "============================================\n";
