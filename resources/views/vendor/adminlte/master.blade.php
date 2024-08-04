<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('storage/public/css/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/js/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ storage('admin/vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @else
        <link rel="stylesheet" href="{{ storage('public/css/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset(config('laravel_mix_css_libs', 'assets/admin/css/libs.css')) }}">
        <link rel="stylesheet" href="{{ storage('public/js/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('storage/admin/vendor/adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset(config('laravel_mix_css_main', 'assets/admin/css/style.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    @stack('style')
</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('public/js/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('storage/admin/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/libs.js') }}"></script>
        <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    @else
        <script src="{{ asset(config('adminlte.laravel_mix_js_libs', 'assets/admin/js/libs.js')) }}"></script>
        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])
        <script src="{{ asset('storage/admin/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset(config('adminlte.laravel_mix_js_main', 'assets/admin/js/main.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
    @yield('adminlte_js')

    @stack('script')

</body>

</html>
