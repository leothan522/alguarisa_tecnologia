<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Alguarisa') - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="App de la Dirección de Tecnología y Sistemas de Alimentos del Guárico S.A.">
    <meta name="theme-color" content="#0056b3">

    <meta property="og:title" content="Tecnología ALGUARISA">
    <meta property="og:description" content="App de la Dirección de Tecnología y Sistemas de Alimentos del Guárico S.A.">
    <meta property="og:image" content="{{ asset('favicons/favicon-128x128.png') }}">

    {{-- Favicon y PWA --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicons/favicon-128x128.png') }}">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    {{--<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">--}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    {{--<link rel="stylesheet" href="../../dist/css/adminlte.min.css">--}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    @livewireStyles
    @yield('css')
    {{-- PRELOADER--}}
    <style>
        .loader-section {
            width: 100vw;
            height: 100vh;
            max-width: 100%;
            position: fixed;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            z-index: 999;
            transition: all 1s 1s ease-out;
            opacity: 1;
        }

        .loaded {
            opacity: 0;
            z-index: -1;
        }

        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #623ddb;
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <div class="loader-section">
        {{--<span class="loader"></span>--}}
        <img src="{{ asset(config('adminlte.preloader.img.path', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
             class="{{ config('adminlte.preloader.img.effect', 'animation__shake') }}"
             alt="{{ config('adminlte.preloader.img.alt', 'AdminLTE Preloader Image') }}"
             width="{{ config('adminlte.preloader.img.width', 60) }}"
             height="{{ config('adminlte.preloader.img.height', 60) }}">
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3">


        <!-- Main content -->
        <div class="content">
            <div class="container">
                @yield('content')
                {!! verToastBootstrap() !!}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
{{--<script src="../../plugins/jquery/jquery.min.js"></script>--}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
{{--<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<!-- AdminLTE App -->
{{--<script src="../../dist/js/adminlte.min.js"></script>--}}
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
@livewireScripts
<x-livewire-alert::scripts/>
<script src="{{ asset('js/toastBootstrap.js') }}"></script>
@include('layouts.toastBootstrap')
@yield('js')
<script>
    function pageLoaded() {
        let loaderSection = document.querySelector('.loader-section');
        loaderSection.classList.add('loaded');
    }

    document.onload = pageLoaded();
</script>
</body>
</html>
