<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            @if($nuevo)
                Registrar
            @endif
            @if($editar)
                Editar
            @endif
            Bienes
        </h3>
        <div class="card-tools">
            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
            @if(!$nuevo)
                <button class="btn btn-tool" wire:click="create">
                    <i class="fas fa-file"></i> Nuevo</button>
            @endif
            @if($editar)
                <button class="btn btn-tool" {{--wire:click="destroy({{ $articulos_id }})"--}}
                        @if(!comprobarPermisos('articulos.destroy')) disabled @endif >
                    <i class="fas fa-edit"></i>
                    Editar
                </button>
                {{--<a href="--}}{{--{{ route('etiquetas.print', $articulos_id) }}--}}{{--#" target="_blank" class="btn btn-tool"><i class="fas fa-print"></i> Imprimir Etiqueta</a>--}}
            @endif

            @if($nuevo || $editar)
                <button class="btn btn-tool" wire:click="limpiar">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            @endif

        </div>
    </div>

    <div class="card-body">

        <div @if(!$form) class="d-none" @endif >
            @include('dashboard.bienes._layout.form')
        </div>

        <div @if(!$show) class="d-none" @endif >
            hola
        </div>

        <div class="row m-5 @if(!$view) d-none @endif ">
            <div class="col-12">
                Debes seleccionar un Bien para empezar...
            </div>
        </div>

    </div>

    <div class="card-footer text-center @if(!$footer) d-none @endif">

        <button type="button" class="btn btn-default btn-sm" {{--wire:click="btnImagen"--}}
                {{--@if(!$estatus) disabled @endif--}}>
            <i class="fas fa-images"></i> Imagenes
        </button>

        <button type="button" class="btn btn-default btn-sm" wire:click="destroy()"
                @if(!comprobarPermisos()) disabled @endif>
            <i class="fas fa-trash-alt"></i> Eliminar
        </button>

    </div>


    {!! verSpinner() !!}

</div>
