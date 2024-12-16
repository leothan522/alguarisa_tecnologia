@extends('layouts.auth_bootstrap')

@section('content')

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
                                        <img class="img-fluid" src="{{ asset('img/logo_alguarisa.png') }}" alt="logo">
                                        <h6 class="mt-1 mb-4 pb-1 text_title"><strong>Dirección de Tecnología y Sistemas.</strong></h6>
                                    </div>

                                    <form class="needs-validation" method="POST" action="{{ route('login') }}" novalidate>
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

                                        @if (session('status'))
                                            <div class="mb-4">
                                                <p class="fs-6 text-primary fw-normal">
                                                    {{ session('status') }}
                                                </p>
                                            </div>
                                        @endif

                                        <div class="form-outline mb-4 has-validation">
                                            <label class="form-label" for="email">{{ __('Email') }}</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus/>
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Email') }}.
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4 has-validation">
                                            <label class="form-label" for="password">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Clave" required />
                                            <div class="invalid-feedback">
                                                Por favor ingrese su {{ __('Password') }}.
                                            </div>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1 d-grid gap-2">

                                            <button type="submit" class="btn shadow text-white btn-block fa-lg gradient-custom-2 mb-3">{{ __('Log in') }}</button>

                                            @if (Route::has('password.request'))
                                                <a class="text-muted" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                            @endif
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            @if (Route::has('register'))
                                                <p class="mb-0 me-2">¿No tienes una cuenta?</p>
                                                <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __('Register') }}</a>
                                            @endif
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

@section('js')
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
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
