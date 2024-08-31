@extends('layouts.adminlte')

@section('plugins.Lightbox', true)

@section('title')
    TECNOLOGÍA | CONSULTA DE BIENES
@endsection

@section('content')

    <!-- Profile Image -->
    <div class="card card-navy card-outline" xmlns:wire="http://www.w3.org/1999/xhtml">
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

            <h3 class="profile-username text-center mb-3">CONSULTA DE BIENES</h3>

            {{--<p class="text-muted text-center">Identificador: JHBJHBSAJHBCJABAJ</p>--}}

            <ul class="list-group mb-3">
                @if(!empty($bien->identificador))
                    <li class="list-group-item list-group-item-dark">
                        <span>Identificador</span> <span class="float-right text-bold">{{ strtoupper(verUtf8($bien->identificador)) }}</>
                    </li>
                @endif
                @if(!empty($bien->serial))
                    <li class="list-group-item list-group-item-dark">
                        <span>Serial</span> <span
                            class="float-right text-bold">{{ strtoupper(verUtf8($bien->serial)) }}</span>
                    </li>
                @endif
                <li class="list-group-item list-group-item-dark card_mostrar_datos">
                    <span>Tipo</span> <span
                        class="float-right text-bold">{{ strtoupper(verUtf8($bien->tipo->nombre)) }}</span>
                </li>
                <li class="list-group-item list-group-item-dark card_mostrar_datos">
                    <span>Marca</span> <span
                        class="float-right text-bold">{{ strtoupper(verUtf8($bien->marca->nombre)) }}</span>
                </li>
                <li class="list-group-item list-group-item-dark card_mostrar_datos">
                    <span>Modelo</span> <span
                        class="float-right text-bold">{{ strtoupper(verUtf8($bien->modelo->nombre)) }}</span>
                </li>
                <li class="list-group-item list-group-item-dark card_mostrar_datos">
                    <span>Color</span> <span
                        class="float-right text-bold">{{ strtoupper(verUtf8($bien->color->nombre)) }}</span>
                </li>
                <li class="list-group-item list-group-item-dark card_mostrar_datos">
                    <span>Condición</span> <span
                        class="float-right text-bold">{{ strtoupper(verUtf8($bien->condicion->nombre)) }}</span>
                </li>
                @if($bien->adicional)
                    <li class="list-group-item list-group-item-dark card_mostrar_datos">
                        <span>Información Adicional</span> <span
                            class="float-right text-bold">{{ strtoupper(verUtf8($bien->adicional)) }}</span>
                    </li>
                @endif

            </ul>

            <div class="row justify-content-center attachment-block p-3 card_mostrar_datos">
                <div class="col-md-8 mb-3 mt-3">
                    <div class="text-center" style="cursor: pointer;">
                        @php($ver = true)
                        @if($imagenFrontal)
                            <a href="{{ verImagen($imagenFrontal->imagen, false, true) }}" data-toggle="lightbox"
                               data-gallery="example-gallery" data-title="Imagen Frontal">
                                <img class="img-thumbnail" src="{{ asset(verImagen($imagenFrontal->mini ?? null)) }}"
                                     alt="Imagen Frontal"/>
                            </a>
                        @else
                            @if($imagenPosterior)
                                @php($ver = false)
                                <a href="{{ verImagen($imagenPosterior->imagen, false, true) }}" data-toggle="lightbox"
                                   data-gallery="example-gallery" data-title="Imagen Posterior">
                                    <img class="img-thumbnail"
                                         src="{{ asset(verImagen($imagenPosterior->mini ?? null)) }}"
                                         alt="Imagen Posterior"/>
                                </a>
                            @else
                                <img class="img-thumbnail" src="{{ asset(verImagen(null, false, true)) }}"
                                     alt="Imagen del Bien"/>
                            @endif
                        @endif
                        @if($imagenPosterior && $ver)
                            <a href="{{ verImagen($imagenPosterior->imagen, false, true) }}" data-toggle="lightbox"
                               data-gallery="example-gallery" data-title="Imagen Posterior"></a>
                        @endif
                    </div>
                </div>
            </div>

            <a href="{{ route('etiquetas.web', $bien->token ?? $bien->id) }}"
               class="btn btn-default btn-block d-none card_cambiar_imagenes">
                <i class="fas fa-sync-alt"></i> Actualizar
            </a>

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
                <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal_login">
                    <i class="fas fa-sign-in-alt"></i> {{ __('Log in') }}
                </button>
            @endauth

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="d-none card_cambiar_imagenes">
        @livewire('dashboard.imagenes-component')
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

@section('js')
    <script src="{{ asset('vendor/ekko-lightbox/ekko-lightbox.js') }}"></script>
    <script>

        function verSpinnerOculto() {
            $('.cargar_bienes').removeClass('d-none');
        }

        function btnOficios(id) {
            verSpinnerOculto();
            Livewire.dispatch('getBienesOficios', {bienID: id});
        }

        function btnUbicacion(id) {
            Livewire.dispatch('getBienesUbicaciones', {bienID: id});
        }

        function btnCambiarImagenes(id) {
            $('.card_mostrar_datos').addClass('d-none');
            $('.card_cambiar_imagenes').removeClass('d-none');
            Livewire.dispatch('showImagenes', {id: id});
        }

        function clickImgFrontal() {
            $('#customFileLangFrontal').click();
        }

        function clickImgPosterior() {
            $('#customFileLangPosterior').click();
        }

        Livewire.on('cerrarModalLogin', ({nombre}) => {
            location.reload();
            //$('#btn_modal_login_cerrar').click();
        });

        function cerrarSesion() {
            $('#btn_cerrar_sesion').click();
        }


        /* Ekko Lightbox */
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        });

    </script>
@endsection
