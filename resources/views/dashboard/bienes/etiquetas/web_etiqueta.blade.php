@extends('layouts.adminlte')

@section('plugins.Lightbox', true)

@section('title')
    TECNOLOGÍA | CONSULTA DE BIENES
@endsection

@section('content')

    <!-- Profile Image -->
    <div class="card card-navy card-outline">
        <div class="card-body box-profile">

            @auth
                <button type="button" class="btn btn-tool" onclick="cerrarSesion()">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
                </button>
            @endauth

            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/preloader_171x171.png') }}"
                     alt="Logo Alguarisa">
            </div>

            <h3 class="profile-username text-center mb-3 card_mostrar_datos">CONSULTA DE BIENES</h3>
            <h3 class="profile-username text-uppercase text-center mb-3 d-none card_cambiar_imagenes">Cambiar
                Imagenes</h3>

            {{--<p class="text-muted text-center">Identificador: JHBJHBSAJHBCJABAJ</p>--}}

            <div class="card card-outline card-navy card_mostrar_datos">

                <div class="card-header">
                    <h5 class="card-title">Información</h5>
                    <div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-book"></i></span>
                    </div>
                </div>

                <div class="card-body p-0">

                    <ul class="todo-list list-group list-group-flush">
                        @if(!empty($bien->identificador))
                            <li class="list-group-item">
                                <span>Identificador: </span>
                                <span
                                    class="float-right text-bold text-lightblue text-uppercase">{{ $bien->identificador }}</span>
                            </li>
                        @endif
                        @if(!empty($bien->serial))
                            <li class="list-group-item">
                                <span>Serial: </span>
                                <span
                                    class="float-right text-bold text-lightblue text-uppercase">{{ $bien->serial }}</span>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <span>Tipo: </span>
                            <span
                                class="float-right text-bold text-lightblue text-uppercase">{{ $bien->tipo->nombre }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Marca: </span>
                            <span
                                class="float-right text-bold text-lightblue text-uppercase">{{ $bien->marca->nombre }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Modelo: </span>
                            <span
                                class="float-right text-bold text-lightblue text-uppercase">{{ $bien->modelo->nombre }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Color: </span>
                            <span
                                class="float-right text-bold text-lightblue text-uppercase">{{ $bien->color->nombre }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Condición: </span>
                            <span
                                class="float-right text-bold text-lightblue text-uppercase">{{ $bien->condicion->nombre }}</span>
                        </li>
                        @if(!empty($bien->adicional))
                            <li class="list-group-item">
                                <span>Información Adicional: </span><br>
                                <span class="text-bold text-lightblue text-uppercase">{{ $bien->adicional }}</span>
                            </li>
                        @endif
                    </ul>

                </div>

            </div>

            <div class="card card-outline card-navy d-none card_cambiar_imagenes">

                <div class="card-header">
                    <h5 class="card-title">Información</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" onclick="btnCancelar()">
                            <i class="fas fa-ban"></i> Cancelar
                        </button>
                    </div>
                </div>

                <div class="card-body p-0">

                    <ul class="todo-list list-group list-group-flush">
                        @if(!empty($bien->identificador))
                            <li class="list-group-item">
                                <span>Identificador: </span>
                                <span
                                    class="float-right text-bold text-lightblue text-uppercase">{{ $bien->identificador }}</span>
                            </li>
                        @endif
                        @if(!empty($bien->serial))
                            <li class="list-group-item">
                                <span>Serial: </span>
                                <span
                                    class="float-right text-bold text-lightblue text-uppercase">{{ $bien->serial }}</span>
                            </li>
                        @endif
                    </ul>

                </div>

            </div>

            <div class="card card-navy card-outline collapsed-card card_mostrar_datos">
                <div class="card-header">
                    <h3 class="card-title">Imagenes</h3>
                    <div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-images"></i></span>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body attachment-block p-0 m-0">

                    <div class="row justify-content-center">

                        <div class="row col-12 justify-content-center mb-3 mt-3">
                            <div class="col-7 col-md-4 mb-2">
                                @if($imagenFrontal)
                                    <a href="{{ verImagen($imagenFrontal->imagen, false, true) }}"
                                       data-toggle="lightbox" data-gallery="example-gallery"
                                       data-title="Imagen Frontal">
                                        <img class="img-thumbnail"
                                             src="{{ verImagen($imagenFrontal->mini, false, true) }}"
                                             alt="Imagen Frontal"/>
                                    </a>
                                @else
                                    <img class="img-thumbnail" src="{{ verImagen(null, false, true) }}"
                                         alt="Imagen Frontal"/>
                                @endif
                            </div>
                            <div class="col-7 col-md-4">
                                @if($imagenPosterior)
                                    <a href="{{ verImagen($imagenPosterior->imagen, false, true) }}"
                                       data-toggle="lightbox" data-gallery="example-gallery"
                                       data-title="Imagen Posterior">
                                        <img class="img-thumbnail"
                                             src="{{ verImagen($imagenPosterior->mini, false, true) }}"
                                             alt="Imagen Posterior"/>
                                    </a>
                                @else
                                    <img class="img-thumbnail" src="{{ verImagen(null, false, true) }}"
                                         alt="Imagen Posterior"/>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="d-none card_cambiar_imagenes">
                @livewire('dashboard.bienes-imagenes-component')
            </div>

            <button type="button" class="btn btn-default btn-block card_mostrar_datos"
                    {{--wire:click="btnUbicacion"--}} onclick="btnUbicacion({{ $bien->id }})"
                    data-toggle="modal" data-target="#modal-sm-bien-ubicacion"
                {{--@if(!comprobarPermisos('bienes.edit')) disabled @endif--}}>
                <i class="fas fa-thumbtack"></i> Ubicación
            </button>

            <button type="button" class="btn btn-default btn-block card_mostrar_datos"
                    {{--wire:click="btnOficios"--}} onclick="btnOficios({{ $bien->id }})"
                    data-toggle="modal" data-target="#modal-sm-bien-oficios"
                {{--@if(!comprobarPermisos('bienes.edit')) disabled @endif--}}>
                <i class="fas fa-file-invoice"></i> Vinculados
            </button>

            @auth

                <button type="button" class="btn btn-default btn-block card_mostrar_datos"
                        {{--wire:click="btnImagenes"--}} onclick="btnCambiarImagenes({{ $bien->id }})"
                        @if(!comprobarPermisos('bienes.edit')) disabled @endif>
                    <i class="fas fa-images"></i> Cambiar Imagenes
                </button>

                <form class="d-none" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" value="cerrar" id="btn_cerrar_sesion">
                </form>

            @else
                <button type="button" class="btn btn-default btn-block" data-toggle="modal"
                        data-target="#modal_login">
                    <i class="fas fa-sign-in-alt"></i> {{ __('Log in') }}
                </button>
            @endauth

            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>



    <div class="row">
        @livewire('dashboard.modal-ubicaciones-component')
        @livewire('dashboard.modal-oficios-vinculados-component')
        @livewire('web.login-component')
    </div>

@endsection

@section('css')
    {{--<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">--}}
    <link rel="stylesheet" href="{{ asset('vendor/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@include('dashboard.bienes.etiquetas.scripts')
