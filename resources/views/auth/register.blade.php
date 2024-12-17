@extends('layouts.auth_bootstrap')

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

                                    <form class="needs-validation" method="POST" action="{{ route('register') }}" novalidate>
                                        @csrf

                                        @if ($errors->any())
                                            <div>
                                                <div class="fs-6 text-danger fw-normal">{{ __('Whoops! Something went wrong.') }}</div>

                                                <ul class="mt-3 fs-6 text-danger fw-normal">
                                                    @foreach ($errors->all() as $error)
                                                        <li><small>{{ $error }}</small></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="form-floating mb-3 has-validation">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre Apellido" required autofocus />
                                            <label for="name">{{ __('Name') }}</label>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Name') }}.
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3 has-validation">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required />
                                            <label for="email">{{ __('Email') }}</label>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Email') }}.
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3 has-validation">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                                            <label for="password">{{ __('Password') }}</label>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Password') }}.
                                            </div>
                                        </div>

                                        <div class="form-floating mb-3 has-validation">
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Password" required>
                                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                            <div class="invalid-feedback">
                                                Por favor {{ __('Confirm Password') }}.
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 d-grid gap-2">

                                            <button type="submit" class="btn shadow text-white btn-block fa-lg gradient-custom-2 mb-3">{{ __('Register') }}</button>
                                            <a class="text-muted" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                                        </div>

                                    </form>

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

