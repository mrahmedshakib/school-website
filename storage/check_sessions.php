<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sessions = Illuminate\Support\Facades\DB::table('sessions')->get();
echo "Total sessions in DB: " . $sessions->count() . PHP_EOL;
foreach ($sessions as $s) {
    echo "ID: " . substr($s->id, 0, 10) . "... | user_id: " . ($s->user_id ?? 'NULL') . " | last_activity: " . date('Y-m-d H:i:s', $s->last_activity) . PHP_EOL;
}
