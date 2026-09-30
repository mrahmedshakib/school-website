<!DOCTYPE html>
<html lang="bn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admit Card - {{ $application->application_no }}</title>

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
            margin: 10mm 15mm 10mm 15mm;
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
            font-family: 'Kalpurush', sans-serif !important;
        }

        body {
            font-size: 11px;
            color: #0f172a;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .border-box {
            border: 2px solid #1e40af;
            border-radius: 8px;
            padding: 15px;
            position: relative;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .header-table td {
            border: 0;
            padding: 0;
            vertical-align: middle;
        }

        .school-logo {
            width: 60px;
            height: 60px;
        }

        .school-title-bn {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
            line-height: 1.2;
        }

        .school-title-en {
            font-size: 12px;
            font-weight: bold;
            color: #334155;
            margin-top: 2px;
        }

        .school-meta {
            font-size: 10px;
            color: #64748b;
        }

        .doc-ribbon {
            background: #1e40af;
            color: #ffffff;
            text-align: center;
            padding: 4px 15px;
            font-size: 13px;
            font-weight: bold;
            border-radius: 20px;
            display: inline-block;
            margin: 0 auto 12px auto;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 5px 8px;
            border-bottom: 1px dashed #cbd5e1;
            font-size: 11px;
        }

        .info-table td.label {
            width: 30%;
            font-weight: bold;
            color: #334155;
        }

        .info-table td.val {
            width: 70%;
            color: #0f172a;
        }

        .photo-box {
            width: 100px;
            height: 120px;
            border: 1px solid #94a3b8;
            border-radius: 4px;
            text-align: center;
            vertical-align: middle;
            font-size: 10px;
            color: #94a3b8;
        }

        .instructions {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px;
            font-size: 9.5px;
            color: #334155;
            margin-top: 15px;
        }

        .instructions h4 {
            margin: 0 0 5px 0;
            color: #1e40af;
            font-size: 10.5px;
        }

        .instructions ol {
            margin: 0;
            padding-left: 15px;
        }

        .instructions li {
            margin-bottom: 3px;
        }

        .sig-table {
            width: 100%;
            margin-top: 40px;
        }

        .sig-table td {
            width: 50%;
            border: 0;
            vertical-align: bottom;
        }
    </style>
</head>
<body>

<div class="border-box">

    {{-- HEADER --}}
    <table class="header-table">
        <tr>
            <td style="width: 70px;">
                @if($logoPath)
                    <img src="{{ $logoPath }}" class="school-logo" alt="Logo">
                @endif
            </td>
            <td style="text-align: center;">
                <div class="school-title-bn">{{ $websiteSetting->school_name_bn ?? 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ' }}</div>
                <div class="school-title-en">{{ $websiteSetting->school_name ?? 'BIAM LABORATORY SCHOOL & COLLEGE' }}</div>
                <div class="school-meta">দুপচাঁচিয়া, বগুড়া • EIIN: {{ $websiteSetting->eiin_no ?? '136746' }} • স্থাপিত: ২০১০</div>
            </td>
            <td style="width: 70px; text-align: right;">
                <div style="font-size: 9px; color: #64748b; line-height: 1.2;">
                    শিক্ষাবর্ষ<br>
                    <strong style="font-size: 13px; color: #1e40af;">{{ $application->academic_year ?? date('Y') }}</strong>
                </div>
            </td>
        </tr>
    </table>

    <div style="text-align: center;">
        <div class="doc-ribbon">
            ভর্তি পরীক্ষা ও লটারির প্রবেশপত্র (ADMIT CARD)
        </div>
    </div>

    {{-- STUDENT & ADMIT CARD DETAILS --}}
    <table style="width: 100%; border: 0;">
        <tr>
            <td style="vertical-align: top; width: 75%;">
                <table class="info-table">
                    <tr>
                        <td class="label">আবেদন নম্বর (App No):</td>
                        <td class="val"><strong style="font-size: 12px; color: #1e40af;">{{ $application->application_no }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">শিক্ষার্থীর নাম (বাংলায়):</td>
                        <td class="val"><strong>{{ $application->student_name_bn ?? $application->student_name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Name (English):</td>
                        <td class="val"><strong>{{ $application->student_name_en }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">ভর্তিচ্ছু শ্রেণি (Class):</td>
                        <td class="val"><strong>{{ $application->class }}</strong> @if($application->group_name) ({{ $application->group_name }}) @endif</td>
                    </tr>
                    <tr>
                        <td class="label">জন্ম তারিখ ও লিঙ্গ:</td>
                        <td class="val">{{ optional($application->date_of_birth)->format('d F, Y') }} | {{ $application->gender === 'male' ? 'ছাত্র' : ($application->gender === 'female' ? 'ছাত্রী' : 'অন্যান্য') }}</td>
                    </tr>
                    <tr>
                        <td class="label">পিতার নাম:</td>
                        <td class="val">{{ $application->father_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">মাতার নাম:</td>
                        <td class="val">{{ $application->mother_name }}</td>
                    </tr>
                    <tr>
                        <td class="label">অভিভাবকের মোবাইল:</td>
                        <td class="val"><strong>{{ $application->guardian_phone }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">পরীক্ষা/লটারির স্থান:</td>
                        <td class="val">বিদ্যালয় ক্যাম্পাস, দুপচাঁচিয়া, বগুড়া</td>
                    </tr>
                </table>
            </td>

            <td style="vertical-align: top; width: 25%; text-align: right;">
                @if($studentPhotoPath)
                    <img src="{{ $studentPhotoPath }}" style="width: 110px; height: 135px; object-fit: cover; border: 2px solid #1e40af; border-radius: 6px;" alt="Student Photo">
                @else
                    <div style="width: 110px; height: 135px; border: 1px dashed #94a3b8; text-align: center; padding-top: 50px; font-size: 10px; color: #94a3b8;">
                        ছবি নেই
                    </div>
                @endif
            </td>
        </tr>
    </table>

    {{-- INSTRUCTIONS --}}
    <div class="instructions">
        <h4>জরুরি নির্দেশনাবলী:</h4>
        <ol>
            <li>লটারি বা ভর্তি পরীক্ষার দিন পরীক্ষার্থীকে অবশ্যই এই প্রবেশপত্রের মূল কপি সঙ্গে আনতে হবে।</li>
            <li>পরীক্ষা বা লটারি শুরুর অন্তত ৩০ মিনিট পূর্বে বিদ্যালয় প্রাঙ্গণে উপস্থিত হতে হবে।</li>
            <li>ভর্তি সম্পর্কিত ফলাফল বিদ্যালয়ের ওয়েবসাইট ও নোটিশ বোর্ডে প্রকাশ করা হবে।</li>
            <li>প্রবেশপত্রে কোনো প্রকার ঘষামাজা বা পরিবর্তন গ্রহণযোগ্য হবে না।</li>
        </ol>
    </div>

    {{-- SIGNATURES --}}
    <table class="sig-table">
        <tr>
            <td style="text-align: left;">
                <div style="border-top: 1px solid #64748b; width: 140px; text-align: center; padding-top: 4px; font-size: 10px;">
                    আহ্বায়ক / ভর্তি কমিটি
                </div>
            </td>
            <td style="text-align: right;">
                <div style="border-top: 1px solid #64748b; width: 140px; margin-left: auto; text-align: center; padding-top: 4px; font-size: 10px; font-weight: bold; color: #1e3a8a;">
                    অধ্যক্ষ / প্রধান শিক্ষক
                </div>
            </td>
        </tr>
    </table>

</div>

</body>
</html>
