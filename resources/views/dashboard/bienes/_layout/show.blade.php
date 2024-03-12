<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            @if(/*$nuevo*/true)
                Registrar
            @endif
            @if(/*$editar*/true)
                Editar
            @endif
            Bien
        </h3>
        <div class="card-tools">
            {{--<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>--}}
            @if(/*!$nuevo*/true)
                <button class="btn btn-tool" wire:click="create">
                    <i class="fas fa-file"></i> Nuevo</button>
            @endif
            @if(/*$editar*/true)
                <button class="btn btn-tool" {{--wire:click="destroy({{ $articulos_id }})"--}}
                        @if(!comprobarPermisos('articulos.destroy')) disabled @endif >
                    <i class="fas fa-edit"></i>
                    Editar
                </button>
                {{--<a href="--}}{{--{{ route('etiquetas.print', $articulos_id) }}--}}{{--#" target="_blank" class="btn btn-tool"><i class="fas fa-print"></i> Imprimir Etiqueta</a>--}}
            @endif

            @if(/*$nuevo || $editar*/true)
                <button class="btn btn-tool" wire:click="limpiarArticulos">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            @endif

        </div>
    </div>

    <div class="card-body">

        @if(/*$nuevo || $editar*/true)
            @include('dashboard.bienes._layout.form')
        @else
            <div class="row m-5">
                <div class="col-12">
                    Debes seleccionar un Bien para empezar...
                </div>
            </div>
        @endif

    </div>

    <div class="card-footer text-center @if(/*!$footer*/true) d-none @endif">

        <button type="button" class="btn btn-default btn-sm" {{--wire:click="btnImagen"--}}
                {{--@if(!$estatus) disabled @endif--}}>
            <i class="fas fa-images"></i> Imagenes
        </button>

        <button type="button" class="btn btn-default btn-sm" {{--wire:click="btnActivoInactivo"--}}
                @if(!comprobarPermisos('articulos.estatus')) disabled @endif >
            @if(/*$estatus*/true)
                <i class="fas fa-check"></i> Operativo
            @else
                <i class="fas fa-ban"></i> Inoperativo
            @endif
        </button>

        <button type="button" class="btn btn-default btn-sm" wire:click="destroy()"
                @if(!comprobarPermisos()) disabled @endif>
            <i class="fas fa-trash-alt"></i> Eliminar
        </button>

    </div>


    {!! verSpinner() !!}

</div>
