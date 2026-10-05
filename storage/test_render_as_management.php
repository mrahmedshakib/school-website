<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

view()->share('errors', new \Illuminate\Support\ViewErrorBag());

$management = App\Models\User::where('email', 'management@gmail.com')->first();
auth()->login($management);

echo "=== MANAGEMENT USER ===" . PHP_EOL;
echo "Logged in as: " . auth()->user()->name . " (" . auth()->user()->email . ")" . PHP_EOL;
echo "isSuperAdmin: " . (auth()->user()->isSuperAdmin() ? 'TRUE' : 'FALSE') . PHP_EOL;

$setting = App\Models\WebsiteSetting::first();
$settingsHtml = view('backend.settings.edit', compact('setting'))->render();

echo "Contains 'Developer Information & Contact Profile': " . (str_contains($settingsHtml, 'Developer Information & Contact Profile') ? 'YES' : 'NO') . PHP_EOL;
echo "Contains 'Access Control / ব্যবহারকারী ও রোল': " . (str_contains($settingsHtml, 'Access Control / ব্যবহারকারী ও রোল') ? 'YES' : 'NO') . PHP_EOL;
echo "Contains 'Users (ব্যবহারকারী)': " . (str_contains($settingsHtml, 'Users (ব্যবহারকারী)') ? 'YES' : 'NO') . PHP_EOL;
echo "Contains 'Roles & Permissions (রোল)': " . (str_contains($settingsHtml, 'Roles & Permissions (রোল)') ? 'YES' : 'NO') . PHP_EOL;

$superAdmin = App\Models\User::where('email', 'superadmin@gmail.com')->first();
auth()->login($superAdmin);

echo PHP_EOL . "=== SUPER ADMIN USER ===" . PHP_EOL;
echo "Logged in as: " . auth()->user()->name . " (" . auth()->user()->email . ")" . PHP_EOL;
echo "isSuperAdmin: " . (auth()->user()->isSuperAdmin() ? 'TRUE' : 'FALSE') . PHP_EOL;

$superSettingsHtml = view('backend.settings.edit', compact('setting'))->render();
echo "Contains 'Developer Information & Contact Profile': " . (str_contains($superSettingsHtml, 'Developer Information & Contact Profile') ? 'YES' : 'NO') . PHP_EOL;
echo "Contains 'Access Control / ব্যবহারকারী ও রোল': " . (str_contains($superSettingsHtml, 'Access Control / ব্যবহারকারী ও রোল') ? 'YES' : 'NO') . PHP_EOL;
echo "Contains 'Users (ব্যবহারকারী)': " . (str_contains($superSettingsHtml, 'Users (ব্যবহারকারী)') ? 'YES' : 'NO') . PHP_EOL;
echo "Contains 'Roles & Permissions (রোল)': " . (str_contains($superSettingsHtml, 'Roles & Permissions (রোল)') ? 'YES' : 'NO') . PHP_EOL;
