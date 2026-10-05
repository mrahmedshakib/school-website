@php
    $websiteSetting = \App\Models\WebsiteSetting::first();
    $schoolNameBn = $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? config('app.name', 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ');
    $schoolNameEn = $websiteSetting->school_name ?? 'BIAM Laboratory School & College';
    $logoUrl = ($websiteSetting && $websiteSetting->logo) ? asset($websiteSetting->logo) : asset('uploads/settings/logo.png');
    $aboutImg = file_exists(public_path('uploads/about/about.jpg')) ? asset('uploads/about/about.jpg') : asset('uploads/sliders/slide-1.jpg');
@endphp
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>প্রশাসন ও শিক্ষক লগইন | {{ $schoolNameBn }}</title>

    @if($websiteSetting && $websiteSetting->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset($websiteSetting->favicon) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #ecfdf5;
            --sky: #0284c7;
            --slate-main: #0f172a;
            --slate-muted: #64748b;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            height: 100vh;
            width: 100vw;
            overflow: hidden; /* No scroll on screen */
        }
        @media (max-width: 959px) {
            html, body {
                height: auto;
                min-height: 100vh;
                overflow-y: auto;
            }
        }
        body {
            background-color: #f8fafc;
            color: var(--slate-main);
            font-family: 'Hind Siliguri', 'Outfit', -apple-system, sans-serif;
        }

        /* Full Screen Split Grid (Fits precisely in 100vh) */
        .login-grid {
            display: grid;
            grid-template-columns: 1fr;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }
        @media (min-width: 960px) {
            .login-grid {
                grid-template-columns: 1.1fr 1fr;
                height: 100vh;
                max-height: 100vh;
            }
        }
        @media (max-width: 959px) {
            .login-grid {
                height: auto;
                overflow: visible;
            }
        }

        /* LEFT SIDE: Brand Showcase & Vision */
        .brand-section {
            position: relative;
            background: linear-gradient(145deg, #042f2e 0%, #064e3b 50%, #022c22 100%);
            color: #ffffff;
            padding: 28px 36px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            height: 100%;
        }
        @media (min-width: 960px) {
            .brand-section {
                padding: 36px 48px;
            }
        }
        .brand-bg-image {
            position: absolute;
            inset: 0;
            background-image: url('{{ $aboutImg }}');
            background-size: cover;
            background-position: center;
            opacity: 0.16;
            filter: saturate(1.2);
            mix-blend-mode: overlay;
        }
        .brand-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            pointer-events: none;
            animation: orb-pulse 18s infinite alternate ease-in-out;
        }
        .brand-orb-1 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.4) 0%, transparent 70%);
            top: -60px;
            left: -60px;
        }
        .brand-orb-2 {
            width: 440px;
            height: 440px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.35) 0%, transparent 70%);
            bottom: -80px;
            right: -60px;
            animation-delay: -6s;
        }
        @keyframes orb-pulse {
            0% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.08) translate(25px, 15px); }
            100% { transform: scale(0.95) translate(-15px, 30px); }
        }

        .brand-content {
            position: relative;
            z-index: 10;
        }
        .brand-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }
        .brand-logo-wrap {
            position: relative;
            width: 54px;
            height: 54px;
            flex-shrink: 0;
        }
        .brand-logo-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
            background: #ffffff;
            display: block;
        }
        .brand-school-meta h2 {
            font-size: 16px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.25;
        }
        .brand-school-meta p {
            font-size: 12px;
            color: #93c5fd;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
        }

        .hero-statement {
            max-width: 520px;
            margin: auto 0;
        }
        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(52, 211, 153, 0.4);
            color: #6ee7b7;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .hero-statement h1 {
            font-size: 26px;
            font-weight: 900;
            line-height: 1.25;
            color: #ffffff;
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }
        @media (min-width: 1200px) {
            .hero-statement h1 { font-size: 32px; }
        }
        .hero-statement p.motto {
            font-size: 13.5px;
            color: #cbd5e1;
            line-height: 1.55;
            margin-bottom: 20px;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 18px;
        }
        .feature-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 10px 14px;
            border-radius: 14px;
            transition: all 0.2s ease;
        }
        .feature-card:hover {
            background: rgba(255, 255, 255, 0.12);
            transform: translateX(4px);
        }
        .feature-icon-wrap {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: rgba(16, 185, 129, 0.25);
            border: 1px solid rgba(52, 211, 153, 0.35);
            color: #6ee7b7;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .feature-text h4 {
            font-size: 13.5px;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
        }
        .feature-text p {
            font-size: 11.5px;
            color: #94a3b8;
            margin-top: 1px;
        }

        .brand-footer {
            font-size: 11.5px;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            padding-top: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* RIGHT SIDE: Interactive Login Console */
        .form-section {
            background: #ffffff;
            position: relative;
            padding: 32px 36px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            overflow-y: auto;
        }
        @media (min-width: 960px) {
            .form-section {
                padding: 40px 54px;
            }
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            margin: auto 0;
        }

        .form-header {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-light);
            border: 1px solid #a7f3d0;
            color: var(--primary-dark);
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 11.5px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .form-title {
            font-size: 26px;
            font-weight: 900;
            color: var(--slate-main);
            letter-spacing: -0.4px;
            margin-bottom: 4px;
            line-height: 1.2;
        }
        .form-sub {
            font-size: 13px;
            color: var(--slate-muted);
            line-height: 1.5;
        }

        /* Alerts */
        .alert-box {
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 12.5px;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 16px;
        }
        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
        }
        .alert-status {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        /* Form Controls */
        .input-group {
            margin-bottom: 16px;
            text-align: left;
        }
        .input-label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }
        .input-box-wrap {
            position: relative;
        }
        .field-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.2s;
        }
        .form-control {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1.5px solid #cbd5e1;
            color: #0f172a;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            background: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.16);
        }
        .input-box-wrap:focus-within .field-icon {
            color: var(--primary);
        }

        .btn-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        .btn-eye:hover {
            color: #334155;
        }

        /* Checkbox & Forgot */
        .options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
            font-size: 12.5px;
            flex-wrap: wrap;
            gap: 8px;
        }
        .remember-checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            color: #475569;
            font-weight: 600;
            user-select: none;
        }
        .checkbox-input {
            width: 16px;
            height: 16px;
            border-radius: 5px;
            border: 1.5px solid #cbd5e1;
            accent-color: var(--primary);
            cursor: pointer;
        }
        .forgot-link {
            color: var(--sky);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }
        .forgot-link:hover {
            color: #0369a1;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 14px 20px;
            border-radius: 14px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-weight: 800;
            font-size: 15px;
            font-family: 'Hind Siliguri', 'Outfit', sans-serif;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.28);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-login:hover {
            filter: brightness(1.08);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.38);
        }
        .btn-login:active {
            transform: translateY(0);
        }

        /* Bottom Nav */
        .form-footer {
            margin-top: 20px;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            color: var(--slate-muted);
            flex-wrap: wrap;
            gap: 8px;
        }
        .back-to-home {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #334155;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.2s;
        }
        .back-to-home:hover {
            color: var(--primary);
            transform: translateX(-3px);
        }
    </style>
</head>
<body>
    <div class="login-grid">
        <!-- LEFT: School Showcase & Vision -->
        <section class="brand-section">
            <div class="brand-bg-image"></div>
            <div class="brand-orb brand-orb-1"></div>
            <div class="brand-orb brand-orb-2"></div>

            <div class="brand-content brand-top">
                <div class="brand-logo-wrap">
                    <img src="{{ $logoUrl }}" onerror="this.src='{{ asset('uploads/settings/logo.png') }}'" class="brand-logo-img" alt="School Logo">
                </div>
                <div class="brand-school-meta">
                    <h2>{{ $schoolNameBn }}</h2>
                    <p>{{ $schoolNameEn }}</p>
                </div>
            </div>

            <div class="brand-content hero-statement">
                <div class="hero-pill">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span>ডিজিটাল শিক্ষা ব্যবস্থাপনা পোর্টাল</span>
                </div>

                <h1>আদর্শ মানুষ গড়ার অনন্য প্রতিষ্ঠান</h1>
                <p class="motto">বিদ্যালয়ের সুষ্ঠু পরিচালনা, শিক্ষক ও কর্মচারীদের প্রাতিষ্ঠানিক দায়িত্ব এবং ফলাফল নিয়ন্ত্রণের জন্য নিবেদিত কেন্দ্রীয় প্রশাসন ব্যবস্থা।</p>

                <div class="features-list">
                    <div class="feature-card">
                        <div class="feature-icon-wrap">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div class="feature-text">
                            <h4>একাডেমিক ও রুটিন ব্যবস্থাপনা</h4>
                            <p>শ্রেণি রুটিন, সিলেবাস, নোটিশ ও পরীক্ষার ফলাফল</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-wrap">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="feature-text">
                            <h4>শিক্ষক ও শিক্ষার্থী প্রোফাইল</h4>
                            <p>সকল শিক্ষক ও শিক্ষার্থীদের সমন্বিত ডেটাবেজ</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-wrap">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div class="feature-text">
                            <h4>নিরাপদ ও এনক্রিপ্টেড সেশন</h4>
                            <p>উচ্চ নিরাপত্তা বিশিষ্ট অ্যাডমিন রোল ও নিয়ন্ত্রণ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="brand-content brand-footer">
                <span>© {{ date('Y') }} {{ $schoolNameBn }}</span>
                <span>Developed by <a href="{{ $websiteSetting->developer_portfolio ?? 'https://mrahmedshakib.github.io/' }}" target="_blank" rel="noopener noreferrer" style="color: #6ee7b7; font-weight: 600; text-underline-offset: 3px; text-decoration: underline;">{{ $websiteSetting->developer_name_en ?? $websiteSetting->developer_name ?? 'Imtiaz Ahmed' }}</a></span>
            </div>
        </section>

        <!-- RIGHT: Interactive Login Form -->
        <section class="form-section">
            <div class="form-container">
                <div class="form-header">
                    <div class="form-badge">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span>প্রশাসন ও শিক্ষক পোর্টাল</span>
                    </div>
                    <h2 class="form-title">অ্যাকাউন্টে লগইন করুন</h2>
                    <p class="form-sub">আপনার নির্ধারিত ইউজার ইমেইল ও পাসওয়ার্ড প্রদান করুন।</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert-box alert-status">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert-box alert-error">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="input-group">
                        <label class="input-label" for="email">ইমেইল এড্রেস (Email Address):</label>
                        <div class="input-box-wrap">
                            <svg class="field-icon" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                autocomplete="username" 
                                placeholder="admin@gmail.com" 
                                class="form-control"
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label class="input-label" for="password">পাসওয়ার্ড (Password):</label>
                        <div class="input-box-wrap">
                            <svg class="field-icon" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="current-password" 
                                placeholder="••••••••" 
                                class="form-control"
                            >
                            <button type="button" class="btn-eye" onclick="togglePasswordVisibility()" title="পাসওয়ার্ড দেখুন/লুকান">
                                <svg id="eye-icon" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="options-row">
                        <label for="remember_me" class="remember-checkbox-label">
                            <input id="remember_me" type="checkbox" name="remember" class="checkbox-input">
                            <span>আমাকে মনে রাখুন</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                পাসওয়ার্ড ভুলে গেছেন?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-login">
                        <span>লগইন করুন</span>
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="form-footer">
                    <a href="{{ route('home') }}" class="back-to-home">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>মূল ওয়েবসাইটে ফিরে যান</span>
                    </a>
                    <span>🛡️ 256-Bit SSL Encrypted</span>
                </div>
            </div>
        </section>
    </div>

    <!-- Toggle Password Visibility -->
    <script>
        function togglePasswordVisibility() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path>';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</body>
</html>
