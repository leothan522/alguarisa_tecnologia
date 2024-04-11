<div class="card card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Busqueda { <b class="text-warning">{{ $keyword }}</b> }
                <button class="btn btn-tool text-warning" wire:click="limpiarBuscar">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Registrados [ <b class="text-warning">{{ $total }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="limpiar">
                <i class="fas fa-sync"></i> Actualizar
            </button>

            <button type="button" class="btn btn-tool" wire:click="create"
                    @if(!comprobarPermisos('oficios.create')) disabled @endif >
                <i class="fas fa-file"></i> Nuevo
            </button>

            <button type="button" class="btn btn-tool" wire:click="setLimit"
                    @if($rows > $listarOficios->count()) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>

    <div class="card-body table-responsive p-0" @if($tableStyle) style="height: 55vh;" @endif >

        <table class="table table-head-fixed table-hover text-nowrap sticky-top">
            <thead>
            <tr class="text-navy">
                <th style="width: 10%">Nro. Oficio</th>
                <th>
                    Detalles
                    <small class="float-right">Mostrando {{ $listarOficios->count() }}</small>
                </th>
            </tr>
            </thead>
        </table>

        <!-- TO DO List -->
        <ul class="todo-list" data-widget="todo-list">
            @if($listarOficios->isNotEmpty())
                @foreach($listarOficios as $oficio)
                    <li class=" @if($oficio->id == $oficios_id) text-warning @endif ">
                        <!-- todo text -->
                        <span class="text text-uppercase">
                            {{ $oficio->numero }}
                    </span>
                        <!-- Emphasis label -->
                        <small class="text text-uppercase {{--badge-danger--}}">
                            Fecha: {{ verFecha($oficio->fecha) }},
                            Equipos: {{ formatoMillares($oficio->equipos, 0) }}
                        </small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools text-primary" wire:click="show({{ $oficio->id }})">
                            <i class="fas fa-eye"></i>
                        </div>
                    </li>
                @endforeach
            @else
                <li class="text-center">
                    <!-- todo text -->
                    @if($keyword)
                        <span class="text">Sin resultados</span>
                    @else
                        <span class="text">Sin registros guardados</span>
                    @endif
                </li>
            @endif

        </ul>
        <!-- /.TO DO List -->

    </div>

</div>
