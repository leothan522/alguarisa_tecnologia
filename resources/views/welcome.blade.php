<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ing. Yonathan Castillo">
    <meta name="generator" content="leothan 0.1">

    <title>{{ config('app.name') }} | @yield('title', 'ALGUARISA')</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!--Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .text_title{
            color: rgba(8,23,44,1);
            font-weight: bold;
        }


        .gradient-custom-2 {
            /* fallback for old browsers */
            background: rgb(18,58,108);

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-radial-gradient(circle, rgba(18,58,108,1) 0%, rgba(8,23,44,1) 100%);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: radial-gradient(circle, rgba(18,58,108,1) 0%, rgba(8,23,44,1) 100%);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }


        .gobernacion{
            display: block;
            position: absolute;
            height: 80px;
            width: 80px;
            right: 3%;
            top: 3%;
        }

        .gobernacion_start{
            display: block;
            position: absolute;
            height: 100px;
            width: 100px;
            left: 3%;
            top: 3%;
        }


    </style>

    @livewireStyles
</head>
<body>


<div class="position-relative gradient-form" style="min-height: 100vh; background-color: #eee;">
    <div class="position-absolute top-50 start-50 translate-middle container py-5 h-100">


        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <img class="gobernacion_start d-sm-none" src="{{ asset('img/logo_gobernacion.svg') }}" alt="Logo Gobernacion">

                                <div class="text-center mt-5 pt-5">
                                    <img class="img-fluid mt-lg-5" src="{{ asset('img/logo_alguarisa.png') }}" alt="logo">
                                    <h6 class="mt-1 mb-5 pb-1 text_title"><strong>Dirección de Tecnología y Sistemas.</strong></h6>
                                </div>

                                <div class="text-center pt-1 mb-5 pb-1">
                                    @auth
                                        <a class="text-muted" href="{{ route('profile.show') }}">{{ __('Profile') }}</a>
                                        <a class="text-muted" href="{{ url('/dashboard') }}">Dashboard</a>
                                    @else
                                        <a class="text-muted" href="{{ route('login') }}">{{ __('Log in') }}</a>
                                        @if (Route::has('register'))
                                            <a class="text-muted ms-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endif
                                    @endauth
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2" style="min-height: 70vh">
                            <img class="gobernacion" src="{{ asset('img/logo_gobernacion_white.png') }}" alt="Logo Gobernacion">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <img class="img-fluid rounded-2 border border-light" src="{{ asset('img/logo_tecnologia.png') }}" alt="logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<input type="hidden" name="" id="navbarSearch">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@livewireScripts
</body>
</html>
