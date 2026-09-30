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