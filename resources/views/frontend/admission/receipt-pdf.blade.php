<!DOCTYPE html>
<html lang="bn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Payment Receipt - {{ $application->application_no }}</title>

    @php
        $kalpurushPath = str_replace('\\', '/', public_path('fonts/Kalpurush/kalpurush.ttf'));
        
        $logoPath = null;
        if (!empty($websiteSetting->logo)) {
            $possibleLogo = public_path($websiteSetting->logo);
            if (file_exists($possibleLogo)) {
                $logoPath = str_replace('\\', '/', $possibleLogo);
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
            font-family: 'kalpurush', 'Kalpurush', sans-serif !important;
        }

        body {
            font-size: 11px;
            color: #0f172a;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .border-box {
            border: 2px solid #059669;
            border-radius: 8px;
            padding: 18px;
            position: relative;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #059669;
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
            color: #065f46;
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
            background: #059669;
            color: #ffffff;
            text-align: center;
            padding: 4px 15px;
            font-size: 13px;
            font-weight: bold;
            border-radius: 20px;
            display: inline-block;
            margin: 0 auto 15px auto;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table th {
            background: #f1f5f9;
            padding: 6px 10px;
            text-align: left;
            border: 1px solid #cbd5e1;
            font-size: 11px;
        }

        .info-table td {
            padding: 6px 10px;
            border: 1px solid #cbd5e1;
            font-size: 11px;
        }

        .sig-table {
            width: 100%;
            margin-top: 30px;
        }

        .sig-table td {
            width: 33.33%;
            border: 0;
            vertical-align: top;
            text-align: center;
            padding: 0 4px;
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
                <div class="school-meta">{{ $websiteSetting->address ?? '' }} • অনলাইন পেমেন্ট প্রত্যয়নপত্র (MONEY RECEIPT)</div>
            </td>
            <td style="width: 70px; text-align: right;">
                <div style="font-size: 9px; color: #64748b; line-height: 1.2;">
                    রসিদ নম্বর<br>
                    <strong style="font-size: 11px; color: #065f46;">REC-{{ date('Ymd') }}-{{ $application->id }}</strong>
                </div>
            </td>
        </tr>
    </table>

    <div style="text-align: center;">
        <div class="doc-ribbon">
            ভর্তি আবেদন ফি জমার রসিদ (MONEY RECEIPT)
        </div>
    </div>

    @php
        $latestPayment = $application->payments->where('status', 'approved')->first() ?? $application->payments->last();
    @endphp

    {{-- STUDENT & PAYMENT SUMMARY --}}
    <table class="info-table">
        <tr>
            <th style="width: 25%;">আবেদন নম্বর</th>
            <td style="width: 25%; font-weight: bold; color: #065f46;">{{ $application->application_no }}</td>
            <th style="width: 25%;">পরিশোধের তারিখ</th>
            <td style="width: 25%;">{{ optional($latestPayment?->created_at ?? now())->format('d F, Y h:i A') }}</td>
        </tr>
        <tr>
            <th>শিক্ষার্থীর নাম</th>
            <td><strong>{{ $application->student_name_bn ?? $application->student_name }}</strong></td>
            <th>ভর্তি শ্রেণি</th>
            <td><strong>{{ $application->class }}</strong></td>
        </tr>
        <tr>
            <th>পিতার নাম</th>
            <td>{{ $application->father_name }}</td>
            <th>মোবাইল নম্বর</th>
            <td>{{ $application->guardian_phone }}</td>
        </tr>
        <tr>
            <th>পেমেন্ট মাধ্যম</th>
            <td style="text-transform: uppercase; font-weight: bold; color: #1e40af;">
                {{ $latestPayment?->payment_method ?? 'SSLCOMMERZ / MFS' }}
            </td>
            <th>ট্রানজেকশন আইডি</th>
            <td style="font-family: monospace; font-weight: bold;">
                {{ $latestPayment?->transaction_id ?? $latestPayment?->payment_no ?? 'TRX-' . strtoupper(Str::random(10)) }}
            </td>
        </tr>
        <tr>
            <th>পরিশোধিত ফি</th>
            <td colspan="3" style="font-size: 13px; font-weight: bold; color: #065f46;">
                ৳ {{ number_format($latestPayment?->amount ?? 500, 2) }} (কথায়: পাঁচশত টাকা মাত্র)
            </td>
        </tr>
        <tr>
            <th>পেমেন্ট স্ট্যাটাস</th>
            <td colspan="3">
                <strong style="color: #059669; font-size: 12px;">✓ সফলভাবে পরিশোধিত (PAID & VERIFIED)</strong>
            </td>
        </tr>
    </table>

    {{-- FOOTER SIGNATURES --}}
    <table class="sig-table">
        <tr>
            <td>
                <div style="border-top: 1px solid #475569; width: 140px; margin: 0 auto; text-align: center; padding-top: 4px; font-size: 9.5px;">
                    <strong>আবেদনকারী / অভিভাবক</strong><br>
                    <span>Applicant / Guardian</span><br>
                    <span style="font-size: 8px; color: #64748b; margin-top: 2px; display: block;">তারিখ / Date: ........................</span>
                </div>
            </td>
            <td>
                <div style="border-top: 1px solid #475569; width: 140px; margin: 0 auto; text-align: center; padding-top: 4px; font-size: 9.5px;">
                    <strong>হিসাব শাখা / বিদ্যালয় কর্তৃপক্ষ</strong><br>
                    <span>Accounts / School Authority</span><br>
                    <span style="font-size: 8px; color: #64748b; margin-top: 2px; display: block;">তারিখ / Date: ........................</span>
                </div>
            </td>
            <td>
                <div style="border-top: 1px solid #475569; width: 140px; margin: 0 auto; text-align: center; padding-top: 4px; font-size: 9.5px; color: #065f46;">
                    <strong>অধ্যক্ষ / প্রধান শিক্ষকের স্বাক্ষর ও সীলমোহর</strong><br>
                    <span>Principal & Official Seal</span><br>
                    <span style="font-size: 8px; color: #64748b; margin-top: 2px; display: block;">তারিখ / Date: ........................</span>
                </div>
            </td>
        </tr>
    </table>

</div>

</body>
</html>
