@extends('layouts.adminlte_print')

@section('title', 'TECNOLOGÍA | IMPRIMIR ETIQUETAS')

@section('content')

    <div class="row m-3">
        <div class="col-12 text-bold ">
            ALIMENTOS DEL GUÁRICO S.A. <br>
            @if(!empty($serial))
                Serial: <span class="text-uppercase">{{ $serial }}</span>
            @else
                @if(!empty($identificador))
                    Identificador: <span class="text-uppercase">{{ $identificador }}</span>
                @endif
            @endif
        </div>
        <div class="row mt-3">
            <div class="col-6 text-center">
                <p>Consulta Local</p>
                <hr>
                {{--{!! QrCode::size(150)->generate($texto); !!}--}}
                {!! qrCodeGenerate($texto, 150, 'qrcodelocal'.rand()) !!}
            </div>
            <div class="col-6 text-center">
                Consulta en Linea
                <hr>
                {{--{!! QrCode::size(150)->generate($url); !!}--}}
                {!! qrCodeGenerate($url, 150, 'qrcodeonline'.rand()) !!}
            </div>
        </div>
    </div>



@endsection

