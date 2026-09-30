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

    @if(!empty($websiteSetting?->favicon))
        <link
            rel="icon"
            href="{{ asset('storage/' . $websiteSetting->favicon) }}"
        >
    @endif

    {{-- ================= GOOGLE FONT ================= --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    {{-- ================= COMMON FRONTEND STYLE ================= --}}

    <style>

        html,
        body {
            font-family: 'Noto Sans Bengali', sans-serif;
        }

        .school-font {
            font-family: 'Noto Sans Bengali', sans-serif;
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