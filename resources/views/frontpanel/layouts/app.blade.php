@php
    $settings = \App\Models\WebsiteSetting::first();
    $web_name = $settings->web_name ?? 'Adinda Store';
    $web_logo = $settings->web_logo ?? 'images/logo.png';
    $web_favicon = $settings->web_favicon ?? 'images/favicon.png';
    $meta_title = $settings->web_meta_title ?? 'Adinda Store - Toko Online';
    $meta_description = $settings->web_meta_description ?? 'Adinda Store adalah toko online terbaik';
    $meta_keywords = $settings->web_meta_keywords ?? 'toko online, belanja, murah, produk terbaru';
@endphp

<!DOCTYPE html>
<html lang="en" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base>

    <title>@yield('title', $meta_title) | {{ $web_name }}</title>

    <link rel="shortcut icon" href="{{ Storage::url($web_favicon) }}">

    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    <meta property="og:title" content="{{ $meta_title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    @if ($settings->web_og_image)
        <meta property="og:image" content="{{ Storage::url($settings->web_og_image) }}">
    @endif

    <link rel="stylesheet" href="{{ asset('frontpanel/themes/default/css/bootstrape55e.css') }}?id=2cbbc8dc06e883c2d672b3cafc1f0765">
    <script src="{{ asset('frontpanel/themes/default/js/app1b42.js') }}?id=faed44020e7d8fb6c8a704322dc94dac"></script>
    <script src="{{ asset('frontpanel/vendor/layer/3.5.1/layer.js') }}"></script>
    <script src="{{ asset('frontpanel/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontpanel/themes/default/css/app1a80.css') }}?id=eff7cca30fdfd01f840ba4a7d4f887c3">
    <script src="{{ asset('frontpanel/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontpanel/vendor/swiper/swiper-bundle.min.css') }}">
    @stack('styles')
</head>
<body class="page-home">
    @include('frontpanel.layouts.components.header')


    <div class="m-0 p-0" id="appContent">
        <section class="module-content">
            @yield('content')
        </section>


    </div>

    @include('frontpanel.layouts.components.footer')


    @stack('scripts')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>
