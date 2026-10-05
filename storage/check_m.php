<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$m = App\Models\User::where('email', 'management@gmail.com')->first();
echo "ID: " . $m->id . PHP_EOL;
echo "role_id: " . $m->role_id . PHP_EOL;
echo "Role: " . ($m->role ? $m->role->name . ' (' . $m->role->slug . ')' : 'NULL') . PHP_EOL;
echo "isSuperAdmin: " . ($m->isSuperAdmin() ? 'TRUE' : 'FALSE') . PHP_EOL;
echo "hasRole('super-admin'): " . ($m->hasRole('super-admin') ? 'TRUE' : 'FALSE') . PHP_EOL;
echo "hasRole('admin'): " . ($m->hasRole('admin') ? 'TRUE' : 'FALSE') . PHP_EOL;
