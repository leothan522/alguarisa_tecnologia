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

        @media (min-width: 768px) {
            #scale {
                transform: scale(0.8); /* Reduce el tamaño al 80% */
            }
        }

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

    <style>
        /* styles.css */
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #fff no-repeat center center;
            z-index: 9999;
        }

        #preloader::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100px;
            height: 100px;
            background: url('{{ asset('img/logo_alguarisa.png') }}') no-repeat center center;
            background-size: contain;
            transform: translate(-50%, -50%);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.2);
            }
            100% {
                transform: translate(-50%, -50%) scale(1);
            }
        }

    </style>
    <script type="application/javascript">
        //Script para ejecurar el preloader
        window.addEventListener('load', function() {
            document.querySelector('#preloader').style.display = 'none';
            document.querySelector('.container').style.display = 'block';
        });
    </script>

    @livewireStyles
    @yield('css')
</head>
<body style="background-color: #eee;">

<div id="preloader"></div>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@livewireScripts
<script type="application/javascript">
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }else {
                    form.classList.add('opacity-50');
                    document.querySelector(".verCargando").classList.remove('d-none');
                }
                form.classList.add('was-validated');
            }, false);
        })
    })()
    console.log('Hi!')
</script>
@yield('js')
</body>
</html>
