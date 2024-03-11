<div class="p-3">
    <ul class="nav nav-pills flex-column">
        {{--@livewire('dashboard.dolar-component')
        <li class="dropdown-divider"></li>--}}
        <li class="nav-item mb-2">
            <span class="text-small text-muted float-right">Tablas</span>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-tipos" onclick=""
                {{--@if(!comprobarPermisos('tipos.index')) disabled @endif--}} >
                Tipos
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-categorias" onclick=""
            {{--@if(!comprobarPermisos('categorias.index')) disabled @endif --}} >
                Marcas
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-unidades" onclick=""
                    {{--@if(!comprobarPermisos('unidades.index')) disabled @endif--}} >
                Modelos
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-procedencias" onclick=""
                {{--@if(!comprobarPermisos('procedencias.index')) disabled @endif--}} >
                Colores
            </button>
        </li>

        @if(auth()->user()->role == 100)

            {{--<li class="nav-item">
                <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                        data-toggle="modal" data-target="#modal-tributarios" onclick="verTributarios()"
                        --}}{{--@if(!comprobarPermisos('tributarios.index')) disabled @endif--}}{{-- >
                    Tributarios
                </button>
            </li>--}}

        @endif
        <li class="dropdown-divider"></li>
        <li class="nav-item mb-2">
            <span class="text-small text-muted float-right">Reportes</span>
        </li>
        <li class="nav-item">
            <button type="button" class="btn btn-primary btn-sm btn-block m-1"
                    data-toggle="modal" data-target="#modal-reportes-articulos"
                {{--@if(!comprobarPermisos('almacenes.index')) disabled @endif--}} >
                Bienes
            </button>
        </li>
        <li class="dropdown-divider"></li>
    </ul>
</div>