<div class="p-3">
    <ul class="nav nav-pills flex-column">
        {{--@livewire('dashboard.dolar-component')
        <li class="dropdown-divider"></li>--}}
        <li class="nav-item mb-2">
            <span class="text-small text-muted float-right">Tablas</span>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-tipos" onclick="verTipos()">
                Tipos
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-marcas" onclick="verMarcas()">
                Marcas
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-modelos" onclick="verModelos()">
                Modelos
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-colores" onclick="verColores()">
                Colores
            </button>
        </li>

        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-condiciones" onclick="verCondiciones()">
                Condiciones
            </button>
        </li>

        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-ubicaciones" onclick="verUbicaciones()">
                Ubicaciones
            </button>
        </li>

        <li class="dropdown-divider"></li>

        <li class="nav-item mb-2">
            <span class="text-small text-muted float-right">Reportes</span>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-reportes-articulos" disabled
                {{--@if(!comprobarPermisos('almacenes.index')) disabled @endif--}} >
                Bienes
            </button>
        </li>
        <li class="dropdown-divider"></li>
    </ul>
</div>
