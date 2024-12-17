@extends('layouts.auth_bootstrap')

@section('title', 'Verificar correo electrónico')

@section('content')

    <div class="position-relative gradient-form" style="min-height: 100vh;">
        <div class="position-absolute top-50 start-50 translate-middle container">


            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <img class="gobernacion_start d-lg-none" src="{{ asset('img/logo_gobernacion.svg') }}" alt="Logo Gobernacion">

                                    <div class="text-center mt-5 mt-sm-auto ">
                                        <a href="{{ route('web.index') }}">
                                            <img class="img-fluid" src="{{ asset('img/logo_alguarisa.png') }}" alt="logo">
                                        </a>
                                        <h6 class="mt-1 mb-4 pb-1 text_title"><strong>Dirección de Tecnología y Sistemas.</strong></h6>
                                    </div>

                                    <form class="needs-validation" method="POST" action="{{ route('verification.send') }}" novalidate>
                                        @csrf

                                        <div class="mb-4">
                                            <p class="fs-6 d-flex">
                                                <small class="text-muted">{{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</small>
                                            </p>
                                        </div>

                                        @if (session('status') == 'verification-link-sent')
                                            <div class="mb-4">
                                                <p class="fs-6 d-flex text-success fw-normal">
                                                    <small>{{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}</small>
                                                </p>
                                            </div>
                                        @endif

                                        <div class="text-center pt-1 mb-3 pb-1 d-grid gap-2">
                                            <button type="submit" class="btn shadow text-white btn-block  gradient-custom-2 mb-3">{{ __('Resend Verification Email') }}</button>
                                        </div>

                                    </form>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <a class="text-muted mb-0 me-2" href="{{ route('profile.show') }}">{{ __('Edit Profile') }}</a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-muted">{{ __('Log Out') }}</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-flex align-items-center gradient-custom-2">
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

@endsection

