<div class="card card-navy">

    <div class="card-header">
        <h3 class="card-title">
            Equipos
        </h3>

        <div class="card-tools">
            {{--@if(/*!$nuevo*/true)
                <button class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('bienes.create')) disabled @endif >
                    <i class="fas fa-file"></i> Nuevo
                </button>
            @endif
            <button type="button" class="btn btn-tool" --}}{{--wire:click="setLimit" @if($rows > $listarBienes->count()) disabled @endif--}}{{-- >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>--}}
        </div>
    </div>

    <div class="card-body table-responsive p-0" @if($equipos > 3) style="height: 30vh;" @endif >

        <table class="table table-head-fixed table-hover text-nowrap sticky-top">
            <thead>
            <tr class="text-navy">
                {{--<th style="width: 10%">Código</th>--}}
                <th>
                    Descripción
                    <small class="float-right">Cantidad {{ $equipos }}</small>
                </th>
            </tr>
            </thead>
        </table>

        <!-- TO DO List -->
        <ul class="todo-list" data-widget="todo-list">
            @if(!empty($listarEquipos))
                @foreach($listarEquipos as $key => $equipo)
                    <li>
                        <!-- todo text -->
                        {{--<span class="text">
                                {{ $equipo->codigo }}
                        </span>--}}
                        <!-- Emphasis label -->
                        <small class="text text-uppercase {{--badge-danger--}}">
                            {{ $equipo['tipo'] }}
                            {{ $equipo['marca'] }}
                            {{ $equipo['modelo'] }}
                            @if(!is_null($equipo['serial']))
                                , Serial: {{ $equipo['serial'] }}
                            @endif
                            @if(!is_null($equipo['identificador']))
                                , Identificador: {{ $equipo['identificador'] }}
                            @endif
                        </small>
                        @if(!$ver)
                            <!-- General tools such as edit or delete-->
                            <div class="tools text-danger" wire:click="btnQuitarEquipo({{ $key }})">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                        @else
                            <div class="tools text-primary" onclick="verBien('{{ $equipo['rowquid'] }}')">
                                <i class="fas fa-eye"></i>
                            </div>
                        @endif
                    </li>
                @endforeach
            @else
                <li class="text-center">
                    <!-- todo text -->
                    <span class="text">Sin Equipos vinculados</span>
                </li>
            @endif

        </ul>
        <!-- /.TO DO List -->

    </div>


</div>
