@extends('layouts.adminlte')

@section('title')
    TECNOLOGÍA | CONSULTA DE BIENES
@endsection

@section('content')

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ asset('img/preloader_171x171.png') }}"
                     alt="User profile picture">
            </div>

            <h3 class="profile-username text-center mb-3">CONSULTA DE BIENES</h3>

            {{--<p class="text-muted text-center">Identificador: JHBJHBSAJHBCJABAJ</p>--}}

            <ul class="list-group list-group-unbordered mb-3">
                @if(!empty($bien->identificador))
                    <li class="list-group-item">
                        <b>IDENTIFICADOR</b> <a class="float-right">{{ strtoupper(verUtf8($bien->identificador)) }}</a>
                    </li>
                @endif
                @if(!empty($bien->serial))
                    <li class="list-group-item">
                        <b>SERIAL</b> <a class="float-right">{{ strtoupper(verUtf8($bien->serial)) }}</a>
                    </li>
                @endif
                <li class="list-group-item">
                    <b>TIPO</b> <a class="float-right">{{ strtoupper(verUtf8($bien->tipo->nombre)) }}</a>
                </li>
                <li class="list-group-item">
                    <b>MARCA</b> <a class="float-right">{{ strtoupper(verUtf8($bien->marca->nombre)) }}</a>
                </li>
                <li class="list-group-item">
                    <b>MODELO</b> <a class="float-right">{{ strtoupper(verUtf8($bien->modelo->nombre)) }}</a>
                </li>
                <li class="list-group-item">
                    <b>COLOR</b> <a class="float-right">{{ strtoupper(verUtf8($bien->color->nombre)) }}</a>
                </li>
                <li class="list-group-item">
                    <b>CONDICIÓN</b> <a class="float-right">{{ strtoupper(verUtf8($bien->condicion->nombre)) }}</a>
                </li>
                @if($bien->adicional)
                    <li class="list-group-item">
                        <b>INFORMACIÓN ADICIONAL</b> <a class="float-right">{{ strtoupper(verUtf8($bien->adicional)) }}</a>
                    </li>
                @endif

            </ul>

            <div class="row justify-content-center attachment-block p-3">
                <div class="col-md-8 mb-3 mt-3">
                    <div class="text-center" style="cursor: pointer;">
                        <img class="img-thumbnail" src="{{ asset(verImagen($imagen->mini ?? null)) }}" alt="Imagen del Bien"/>
                    </div>
                </div>
            </div>

            {{--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>--}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

@endsection

@section('css')
    {{--<link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">--}}
@endsection

@section('js')
    {{--<script src="../../dist/js/adminlte.min.js"></script>--}}
@endsection
