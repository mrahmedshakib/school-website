<!DOCTYPE html>
<html lang="bn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admission Application - {{ $application->application_no }}</title>

    @php
        $kalpurushPath = str_replace('\\', '/', public_path('fonts/Kalpurush/kalpurush.ttf'));
        
        $logoPath = null;
        if (!empty($websiteSetting->logo)) {
            $possibleLogo = public_path($websiteSetting->logo);
            if (file_exists($possibleLogo)) {
                $logoPath = str_replace('\\', '/', $possibleLogo);
            }
        }

        $studentPhotoPath = null;
        if (!empty($application->student_photo)) {
            $possiblePhoto = public_path($application->student_photo);
            if (file_exists($possiblePhoto)) {
                $studentPhotoPath = str_replace('\\', '/', $possiblePhoto);
            }
        }
    @endphp

    <style>
        @page {
            margin: 10mm 14mm 10mm 14mm;
        }

        @font-face {
            font-family: 'Kalpurush';
            src: url('{{ $kalpurushPath }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Kalpurush';
            src: url('{{ $kalpurushPath }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        html, body, table, td, th, div, p, span, h1, h2, h3, h4, h5, h6, strong, b {
            font-family: 'kalpurush', 'Kalpurush', sans-serif !important;
        }

        body {
            font-size: 10.5px;
            color: #0f172a;
            line-height: 1.45;
            margin: 0;
            padding: 0;
        }

        /* HEADER STYLES */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .header-table td {
            border: 0;
            padding: 0;
            vertical-align: middle;
        }

        .school-logo {
            width: 65px;
            height: 65px;
        }

        .school-title-bn {
            font-size: 17px;
            font-weight: bold;
            color: #1e3a8a;
            line-height: 1.3;
        }

        .school-title-en {
            font-size: 11.5px;
            font-weight: bold;
            color: #334155;
            margin-top: 1px;
        }

        .school-meta {
            font-size: 9.5px;
            color: #64748b;
            margin-top: 2px;
        }

        /* RIBBONS & TITLES */
        .doc-ribbon {
            background: #1e40af;
            color: #ffffff;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 3px;
            letter-spacing: 0.3px;
        }

        .admit-ribbon {
            background: #047857;
            color: #ffffff;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            padding: 5px;
            margin-bottom: 6px;
            border-radius: 3px;
        }

        .admit-subtext {
            text-align: center;
            font-size: 9.5px;
            color: #047857;
            margin-bottom: 10px;
            font-style: italic;
        }

        /* META BAR */
        .meta-bar-table {
            width: 100%;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            margin-bottom: 10px;
            border-collapse: collapse;
        }

        .meta-bar-table td {
            padding: 5px 10px;
            font-size: 10px;
            vertical-align: middle;
            border: 0;
        }

        .app-no-badge {
            font-size: 13.5px;
            font-weight: bold;
            color: #1d4ed8;
            font-family: 'Kalpurush', sans-serif !important;
        }

        /* SECTION TITLES */
        .section-bar {
            background: #e2e8f0;
            border-left: 4px solid #1e40af;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 8px;
            margin-bottom: 6px;
        }

        .admit-section-bar {
            background: #dcfce7;
            border-left: 4px solid #059669;
            padding: 4px 8px;
            font-size: 11px;
            font-weight: bold;
            color: #064e3b;
            margin-top: 8px;
            margin-bottom: 6px;
        }

        /* TABLES */
        table.grid-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        table.grid-table td, table.grid-table th {
            border: 1px solid #cbd5e1;
            padding: 4.5px 7px;
            font-size: 10px;
            vertical-align: middle;
        }

        table.grid-table td.label-cell {
            background: #f8fafc;
            font-weight: bold;
            color: #334155;
            width: 25%;
        }

        table.grid-table td.value-cell {
            color: #0f172a;
        }

        /* PHOTO BOX */
        .photo-column {
            width: 96px;
            text-align: center;
            vertical-align: middle;
            background: #ffffff;
            padding: 4px;
        }

        .photo-frame {
            width: 88px;
            height: 108px;
            border: 1px solid #94a3b8;
            padding: 1px;
            margin: auto;
        }

        .no-photo-text {
            width: 88px;
            height: 108px;
            border: 1px dashed #94a3b8;
            margin: auto;
            text-align: center;
            line-height: 108px;
            font-size: 9px;
            color: #94a3b8;
        }

        /* DECLARATION */
        .declaration-box {
            margin-top: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 6px 10px;
            font-size: 9.5px;
            color: #334155;
            line-height: 1.45;
            text-align: justify;
        }

        /* SIGNATURES */
        .signature-table {
            width: 100%;
            margin-top: 36px;
            border-collapse: collapse;
        }

        .signature-table td {
            border: 0;
            text-align: center;
            width: 33.33%;
            padding: 0 8px;
            font-size: 9.5px;
            vertical-align: top;
        }

        .sig-line {
            width: 125px;
            border-top: 1px solid #475569;
            margin: 0 auto 4px;
        }

        /* FOOTER */
        .page-footer {
            margin-top: 14px;
            border-top: 1px solid #cbd5e1;
            padding-top: 5px;
            text-align: center;
            font-size: 8.5px;
            color: #64748b;
        }

        /* PAGE BREAK */
        .page-break {
            page-break-after: always;
        }

        .status-pill {
            display: inline-block;
            padding: 2px 7px;
            background: #dbeafe;
            color: #1e40af;
            font-weight: bold;
            border-radius: 3px;
            font-size: 9.5px;
        }

        .status-pill-success {
            background: #d1fae5;
            color: #065f46;
        }

        .instruction-list {
            margin: 0;
            padding-left: 15px;
            font-size: 9.5px;
            line-height: 1.5;
            color: #334155;
        }

        .instruction-list li {
            margin-bottom: 2px;
        }
    </style>
</head>

<body>

    {{-- ================================================================= --}}
    {{-- PAGE 1: মূল আবেদন ফরম (অফিস কপি) / ADMISSION APPLICATION (OFFICE) --}}
    {{-- ================================================================= --}}

    {{-- Header --}}
    <table class="header-table">
        <tr>
            @if($logoPath)
                <td style="width: 72px; text-align: left;">
                    <img src="{{ $logoPath }}" class="school-logo" alt="Logo">
                </td>
            @endif

            <td style="text-align: {{ $logoPath ? 'left' : 'center' }};">
                <div class="school-title-bn">
                    {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}
                </div>
                <div class="school-title-en">
                    {{ $websiteSetting->school_name ?? '' }}
                </div>
                <div class="school-meta">
                    {{ $websiteSetting->address ?? '' }} @if(!empty($websiteSetting->mobile)) | ফোন: {{ $websiteSetting->mobile }} @endif @if(!empty($websiteSetting->email)) | ই-মেইল: {{ $websiteSetting->email }} @endif
                </div>
            </td>
        </tr>
    </table>

    {{-- Document Title Ribbon --}}
    <div class="doc-ribbon">
        অনলাইন ভর্তি আবেদন ফরম – ২০২৬ (অফিস কপি) / Online Admission Application (Office Copy)
    </div>

    {{-- Meta Bar --}}
    <table class="meta-bar-table">
        <tr>
            <td style="width: 42%;">
                <span style="color: #64748b;">Application Number:</span><br>
                <span class="app-no-badge">{{ $application->application_no }}</span>
            </td>
            <td style="width: 28%; text-align: center;">
                <span style="color: #64748b;">ভর্তির শ্রেণি:</span><br>
                <strong style="font-size: 12px; color: #1e3a8a;">{{ $application->class }}</strong>
            </td>
            <td style="width: 30%; text-align: right;">
                <span style="color: #64748b;">দাখিলের তারিখ ও সময়:</span><br>
                <strong>{{ optional($application->created_at)->format('d-m-Y, h:i A') ?: now()->format('d-m-Y, h:i A') }}</strong>
            </td>
        </tr>
    </table>

    {{-- 1. Student Information --}}
    <div class="section-bar">
        ১. শিক্ষার্থীর সাধারণ তথ্যাদি (Student Information)
    </div>

    <table class="grid-table">
        <tr>
            <td class="label-cell">শিক্ষার্থীর নাম (Student Name)</td>
            <td class="value-cell" style="font-weight: bold; font-size: 11.5px; color: #0f172a;">
                {{ $application->student_name }}
            </td>
            <td class="photo-column" rowspan="5">
                @if($studentPhotoPath)
                    <img src="{{ $studentPhotoPath }}" class="photo-frame" alt="Student Photo">
                @else
                    <div class="no-photo-text">
                        পাসপোর্ট ছবি
                    </div>
                @endif
            </td>
        </tr>
        <tr>
            <td class="label-cell">জন্ম তারিখ (Date of Birth)</td>
            <td class="value-cell">
                @if($application->date_of_birth)
                    {{ \Carbon\Carbon::parse($application->date_of_birth)->format('d F Y') }}
                    <span style="color: #64748b;">({{ \Carbon\Carbon::parse($application->date_of_birth)->format('d/m/Y') }})</span>
                @else
                    উল্লেখ করা হয়নি
                @endif
            </td>
        </tr>
        <tr>
            <td class="label-cell">লিঙ্গ (Gender)</td>
            <td class="value-cell">
                @if($application->gender === 'male')
                    ছেলে (Male)
                @elseif($application->gender === 'female')
                    মেয়ে (Female)
                @else
                    অন্যান্য (Other)
                @endif
            </td>
        </tr>
        <tr>
            <td class="label-cell">যে শ্রেণিতে ভর্তি হতে ইচ্ছুক</td>
            <td class="value-cell" style="font-weight: bold; color: #1d4ed8;">
                {{ $application->class }}
            </td>
        </tr>
        <tr>
            <td class="label-cell">পূর্ববর্তী বিদ্যালয় (Previous School)</td>
            <td class="value-cell">
                {{ $application->previous_school ?: 'প্রযোজ্য নয় (N/A)' }}
            </td>
        </tr>
    </table>

    {{-- 2. Guardian Information --}}
    <div class="section-bar">
        ২. অভিভাবকের তথ্যাদি (Guardian Information)
    </div>

    <table class="grid-table">
        <tr>
            <td class="label-cell">পিতার নাম (Father's Name)</td>
            <td class="value-cell">{{ $application->father_name }}</td>
            <td class="label-cell">মাতার নাম (Mother's Name)</td>
            <td class="value-cell">{{ $application->mother_name }}</td>
        </tr>
        <tr>
            <td class="label-cell">অভিভাবকের মোবাইল নম্বর</td>
            <td class="value-cell" style="font-weight: bold; color: #0f172a;">
                {{ $application->guardian_phone }}
            </td>
            <td class="label-cell">ই-মেইল (Email)</td>
            <td class="value-cell">{{ $application->email ?: 'উল্লেখ করা হয়নি' }}</td>
        </tr>
        <tr>
            <td class="label-cell">বর্তমান ঠিকানা (Address)</td>
            <td class="value-cell" colspan="3">{{ $application->address }}</td>
        </tr>
    </table>

    {{-- 3. Application Fee & Verification --}}
    <div class="section-bar">
        ৩. আবেদন ফি ও যাচাইকরণ সংক্রান্ত তথ্য (Fee & Verification Details)
    </div>

    <table class="grid-table">
        <tr>
            <td class="label-cell">আবেদন ফি (Application Fee)</td>
            <td class="value-cell" style="font-weight: bold;">৳ ৫০০.০০ (পাঁচশত টাকা মাত্র)</td>
            <td class="label-cell">আবেদনের বর্তমান অবস্থা</td>
            <td class="value-cell">
                @if($application->status === 'approved')
                    <span class="status-pill status-pill-success">ভর্তি নিশ্চিত (Approved)</span>
                @elseif($application->status === 'payment_pending')
                    <span class="status-pill">পেমেন্ট যাচাই চলছে</span>
                @else
                    <span class="status-pill">আবেদন গৃহীত (ফি অপরিশোধিত)</span>
                @endif
            </td>
        </tr>
        <tr>
            <td class="label-cell">সংযুক্ত নথিপত্র (Attached)</td>
            <td class="value-cell" colspan="3">
                পাসপোর্ট ছবি: <strong>{{ $application->student_photo ? 'সংযুক্ত আছে' : 'অনুপস্থিত' }}</strong> | 
                জন্ম নিবন্ধন সনদ: <strong>{{ $application->birth_certificate ? 'সংযুক্ত আছে' : 'অনুপস্থিত' }}</strong>
            </td>
        </tr>
    </table>

    {{-- 4. Declaration --}}
    <div class="declaration-box">
        <strong>শিক্ষার্থী ও অভিভাবকের অঙ্গীকারনামা:</strong> আমি এই মর্মে প্রত্যয়ন করছি যে, এই ফরমে প্রদত্ত যাবতীয় তথ্য সম্পূর্ণ সত্য ও নির্ভুল। ভবিষ্যতে কোনো তথ্য অসত্য বা অসম্পূর্ণ প্রমাণিত হলে অত্র প্রতিষ্ঠানে ভর্তি বাতিলসহ আইনানুগ ব্যবস্থা গ্রহণ করা যাবে। আমি এবং আমার সন্তান প্রতিষ্ঠানের যাবতীয় নিয়ম-কানুন ও শৃঙ্খলা মেনে চলতে বাধ্য থাকব।
    </div>

    {{-- Signatures --}}
    <table class="signature-table" style="margin-top: 24px;">
        <tr>
            <td>
                <div class="sig-line"></div>
                <strong>শিক্ষার্থী / অভিভাবকের স্বাক্ষর ও তারিখ</strong><br>
                <span>Applicant / Guardian Signature</span><br>
                <div style="font-size: 8.5px; color: #475569; margin-top: 3px;">তারিখ / Date: ................................</div>
            </td>
            <td>
                <div class="sig-line"></div>
                <strong>ভর্তি কমিটির দায়িত্বপ্রাপ্ত সদস্যের স্বাক্ষর</strong><br>
                <span>Admission Verification Officer</span><br>
                <div style="font-size: 8.5px; color: #475569; margin-top: 3px;">তারিখ / Date: ................................</div>
            </td>
            <td>
                <div class="sig-line"></div>
                <strong>অধ্যক্ষ / প্রধান শিক্ষকের স্বাক্ষর ও সীলমোহর</strong><br>
                <span>Principal & Official Seal</span><br>
                <div style="font-size: 8.5px; color: #475569; margin-top: 3px;">তারিখ / Date: ................................</div>
            </td>
        </tr>
    </table>

    {{-- Page 1 Footer --}}
    <div class="page-footer">
        {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }} | Application No: {{ $application->application_no }} | পৃষ্ঠা ১/২ (অফিস কপি)
    </div>


    {{-- ================================================================= --}}
    {{-- PAGE BREAK --}}
    {{-- ================================================================= --}}
    <div class="page-break"></div>


    {{-- ================================================================= --}}
    {{-- PAGE 2: প্রবেশপত্র ও প্রাপ্তি স্বীকার রসিদ (শিক্ষার্থী কপি)       --}}
    {{-- ================================================================= --}}

    {{-- Header --}}
    <table class="header-table">
        <tr>
            @if($logoPath)
                <td style="width: 72px; text-align: left;">
                    <img src="{{ $logoPath }}" class="school-logo" alt="Logo">
                </td>
            @endif

            <td style="text-align: {{ $logoPath ? 'left' : 'center' }};">
                <div class="school-title-bn">
                    {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}
                </div>
                <div class="school-title-en">
                    {{ $websiteSetting->school_name ?? '' }}
                </div>
                <div class="school-meta">
                    {{ $websiteSetting->address ?? '' }} @if(!empty($websiteSetting->mobile)) | ফোন: {{ $websiteSetting->mobile }} @endif @if(!empty($websiteSetting->email)) | ই-মেইল: {{ $websiteSetting->email }} @endif
                </div>
            </td>
        </tr>
    </table>

    {{-- Admit Ribbon --}}
    <div class="admit-ribbon">
        ভর্তি পরীক্ষার প্রবেশপত্র ও প্রাপ্তি স্বীকার রসিদ – ২০২৬ (শিক্ষার্থী কপি)
    </div>
    <div class="admit-subtext">
        * শিক্ষার্থী ও অভিভাবক এই অংশটি সংরক্ষণ করবেন এবং ভর্তি পরীক্ষা ও চূড়ান্ত ভর্তির সময় অবশ্যই সাথে রাখবেন *
    </div>

    {{-- Admit Meta Bar --}}
    <table class="meta-bar-table">
        <tr>
            <td style="width: 38%;">
                <span style="color: #64748b;">Application Number:</span><br>
                <span class="app-no-badge">{{ $application->application_no }}</span>
            </td>
            <td style="width: 32%; text-align: center;">
                <span style="color: #64748b;">ভর্তির শ্রেণি:</span><br>
                <strong style="font-size: 13px; color: #047857;">{{ $application->class }}</strong>
            </td>
            <td style="width: 30%; text-align: right;">
                <span style="color: #64748b;">পরীক্ষার রোল / সিরিয়াল:</span><br>
                <strong style="font-size: 11px; color: #b45309;">[ অফিস কর্তৃক পূরণীয় ]</strong>
            </td>
        </tr>
    </table>

    {{-- Student Details on Admit Card --}}
    <div class="admit-section-bar">
        শিক্ষার্থী ও পরীক্ষার সাধারণ বিবরণী (Candidate Particulars)
    </div>

    <table class="grid-table">
        <tr>
            <td class="label-cell">শিক্ষার্থীর নাম (Student Name)</td>
            <td class="value-cell" style="font-weight: bold; font-size: 12px; color: #064e3b;">
                {{ $application->student_name }}
            </td>
            <td class="photo-column" rowspan="4">
                @if($studentPhotoPath)
                    <img src="{{ $studentPhotoPath }}" class="photo-frame" alt="Student Photo">
                @else
                    <div class="no-photo-text">
                        পাসপোর্ট ছবি
                    </div>
                @endif
            </td>
        </tr>
        <tr>
            <td class="label-cell">পিতার নাম (Father's Name)</td>
            <td class="value-cell">{{ $application->father_name }}</td>
        </tr>
        <tr>
            <td class="label-cell">মাতার নাম (Mother's Name)</td>
            <td class="value-cell">{{ $application->mother_name }}</td>
        </tr>
        <tr>
            <td class="label-cell">অভিভাবকের মোবাইল নম্বর</td>
            <td class="value-cell" style="font-weight: bold;">{{ $application->guardian_phone }}</td>
        </tr>
    </table>

    {{-- Examination & Venue Details --}}
    <div class="admit-section-bar">
        পরীক্ষা সংক্রান্ত তথ্যাদি (Exam & Venue Details)
    </div>

    <table class="grid-table">
        <tr>
            <td class="label-cell" style="width: 25%;">পরীক্ষা কেন্দ্র (Exam Venue)</td>
            <td class="value-cell" colspan="3" style="font-weight: bold;">
                {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়' }} ক্যাম্পাস, {{ $websiteSetting->address ?? '' }}
            </td>
        </tr>
        <tr>
            <td class="label-cell">পরীক্ষার তারিখ ও সময়</td>
            <td class="value-cell" style="color: #1e40af; font-weight: bold;">
                ভর্তি বিজ্ঞপ্তি অনুযায়ী অথবা SMS-এর মাধ্যমে পরবর্তীতে জানানো হবে
            </td>
            <td class="label-cell">পরীক্ষার বিষয়সমূহ</td>
            <td class="value-cell">বাংলা, ইংরেজি ও গণিত</td>
        </tr>
        <tr>
            <td class="label-cell">আবেদন ফি বিবরণী</td>
            <td class="value-cell" colspan="3">
                নির্ধারিত আবেদন ফি: <strong>৳ ৫০০.০০ (পাঁচশত টাকা মাত্র)</strong> | 
                ফি স্ট্যাটাস: <strong>{{ $application->status === 'approved' ? 'পরিশোধিত (Paid)' : ($application->status === 'payment_pending' ? 'যাচাই প্রক্রিয়াধীন' : 'অপরিশোধিত (Due)') }}</strong>
            </td>
        </tr>
    </table>

    {{-- Candidate Instructions --}}
    <div class="admit-section-bar">
        পরীক্ষার্থী ও অভিভাবকদের জন্য আবশ্যকীয় নির্দেশনাবলী (Instructions)
    </div>

    <div style="background: #f8fafc; border: 1px solid #cbd5e1; padding: 8px 10px; margin-bottom: 8px;">
        <ol class="instruction-list">
            <li>ভর্তি পরীক্ষার দিন এই <strong>প্রবেশপত্রটি (Admit Card)</strong> অবশ্যই সঙ্গে নিয়ে আসতে হবে। প্রবেশপত্র ব্যতীত কাউকে পরীক্ষা কক্ষে প্রবেশ করতে দেওয়া হবে না।</li>
            <li>পরীক্ষা শুরুর অন্তত <strong>২০ মিনিট পূর্বে</strong> নির্ধারিত পরীক্ষা কক্ষে আসন গ্রহণ করতে হবে।</li>
            <li>পরীক্ষার্থীকে প্রয়োজনীয় কলম, পেনসিল, স্কেল, ইরেজার ইত্যাদি সঙ্গে নিয়ে আসতে হবে। পরীক্ষা কক্ষে কোনো সামগ্রী পরস্পরের সাথে বিনিময় করা যাবে না।</li>
            <li>পরীক্ষা কেন্দ্রে মোবাইল ফোন, ক্যালকুলেটর বা যেকোনো ইলেকট্রনিক ডিভাইস আনা সম্পূর্ণরূপে নিষিদ্ধ।</li>
            <li>চূড়ান্ত ভর্তির সময় শিক্ষার্থীর মূল জন্ম নিবন্ধন সনদ, পূর্ববর্তী বিদ্যালয়ের প্রশংসাপত্র/ছাড়পত্র ও ৩ কপি পাসপোর্ট সাইজ ছবি প্রদর্শন করতে হবে।</li>
        </ol>
    </div>

    {{-- Signatures on Admit Card --}}
    <table class="signature-table" style="margin-top: 24px;">
        <tr>
            <td>
                <div class="sig-line"></div>
                <strong>শিক্ষার্থী / অভিভাবকের স্বাক্ষর ও তারিখ</strong><br>
                <span>Applicant / Guardian Signature</span><br>
                <div style="font-size: 8.5px; color: #475569; margin-top: 3px;">তারিখ / Date: ................................</div>
            </td>
            <td>
                <div class="sig-line"></div>
                <strong>হিসাব শাখা / বিদ্যালয় কর্তৃপক্ষ</strong><br>
                <span>Accounts / School Authority</span><br>
                <div style="font-size: 8.5px; color: #475569; margin-top: 3px;">তারিখ / Date: ................................</div>
            </td>
            <td>
                <div class="sig-line"></div>
                <strong>অধ্যক্ষ / প্রধান শিক্ষকের স্বাক্ষর ও সীলমোহর</strong><br>
                <span>Principal & Official Seal</span><br>
                <div style="font-size: 8.5px; color: #475569; margin-top: 3px;">তারিখ / Date: ................................</div>
            </td>
        </tr>
    </table>

    {{-- Page 2 Footer --}}
    <div class="page-footer">
        {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }} @if(!empty($websiteSetting->mobile)) | Helpline: {{ $websiteSetting->mobile }} @endif | পৃষ্ঠা ২/২ (শিক্ষার্থী কপি ও প্রবেশপত্র)
    </div>

</body>
</html>