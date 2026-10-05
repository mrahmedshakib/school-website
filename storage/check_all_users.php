<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

foreach (App\Models\User::all() as $u) {
    echo "ID: {$u->id} | Name: {$u->name} | Email: {$u->email} | Role: " . ($u->role?->name ?? 'NULL') . " | isSuperAdmin: " . ($u->isSuperAdmin() ? 'TRUE' : 'FALSE') . PHP_EOL;
}
