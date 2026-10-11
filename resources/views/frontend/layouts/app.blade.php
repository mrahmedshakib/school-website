<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <meta
        name="description"
        content="@yield('meta_description', '')"
    >

    <meta
        name="keywords"
        content="@yield('meta_keywords', '')"
    >

    @php
        $faviconIco = asset('favicon.ico');
        $faviconPng = asset('favicon-32x32.png');
        $appleTouch = asset('apple-touch-icon.png');

        if (!empty($websiteSetting?->favicon)) {
            if (file_exists(public_path($websiteSetting->favicon))) {
                $customFav = asset($websiteSetting->favicon);
                if (str_ends_with(strtolower($websiteSetting->favicon), '.ico')) {
                    $faviconIco = $customFav;
                } else {
                    $faviconPng = $customFav;
                }
            } elseif (file_exists(public_path('storage/' . $websiteSetting->favicon))) {
                $customFav = asset('storage/' . $websiteSetting->favicon);
                if (str_ends_with(strtolower($websiteSetting->favicon), '.ico')) {
                    $faviconIco = $customFav;
                } else {
                    $faviconPng = $customFav;
                }
            }
        }
        if (!empty($websiteSetting?->logo) && file_exists(public_path($websiteSetting->logo))) {
            $appleTouch = asset($websiteSetting->logo);
        }
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $faviconIco }}">
    <link rel="shortcut icon" href="{{ $faviconIco }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $faviconPng }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $appleTouch }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- ================= KALPURUSH BENGALI FONT ================= --}}
    <style>
        @font-face {
            font-family: 'Kalpurush';
            src: url('{{ asset("fonts/Kalpurush/kalpurush.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        html,
        body,
        button,
        input,
        select,
        textarea,
        p, span, h1, h2, h3, h4, h5, h6, a, label, table,
        .school-font {
            font-family: 'Kalpurush', 'Noto Sans Bengali', sans-serif !important;
        }
    </style>


    {{-- ================= VITE ================= --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    @stack('styles')

</head>


<body
    class="min-h-screen
           bg-white
           text-slate-900
           antialiased"
>

    @include('frontend.layouts.navbar')


    <main>
        @yield('content')
    </main>


    @include('frontend.layouts.footer')

    @stack('scripts')

</body>

</html>