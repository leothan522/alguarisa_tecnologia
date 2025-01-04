<div class="card card-navy card-outline" id="div_table_bienes">

    <div class="card-header">
        <h3 class="card-title">
            @if($keyword || !empty($busqueda))
                @if($keyword)
                    Búsqueda
                    <span class="text-nowrap">{ <b class="text-warning">{{ $keyword }}</b> }</span>
                    <span class="text-nowrap">[ <b class="text-warning">{{ $rows }}</b> ]</span>
                @else
                    Búsqueda Avanzada
                    <span class="text-nowrap">[ <b class="text-warning">{{ $rows }}</b> ]</span>
                @endif

                <button class="d-sm-none btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @else
                Todos [ <b class="text-warning">{{ $rows }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            @if($keyword || !empty($busqueda))
                <button class="d-none d-sm-inline-block btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times"></i>
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool d-sm-none" wire:click="createHide" @if(!comprobarPermisos('empresas.create')) disabled @endif>
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($btnDisabled) disabled @endif>
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>

    <div class="card-body table-responsive p-0" id="table_bienes" wire:loading.class="invisible" wire:target="setLimit, actualizar, cerrarBusqueda, showHide, createHide" style="max-height: calc(100vh - {{ $size }}px)" >

        <table class="table table-head-fixed table-hover text-nowrap sticky-top">
            <thead>
            <tr class="text-lightblue">
                {{--<th class="text-uppercase" style="width: 10%">
                    <!--Código-->
                    &nbsp;
                </th>--}}
                <th>
                    <span class="text-uppercase">Descripción</span>
                    <small class="float-right">Rows {{ $listar->count() }}</small>
                </th>
            </tr>
            </thead>
        </table>

        <!-- TO DO List -->
        <ul class="todo-list" data-widget="todo-list">
            @if($listar->isNotEmpty())
                @foreach($listar as $bien)
                    <li class=" @if($bien->id == $bienes_id) text-warning @endif ">

                        <!-- todo text -->
                        {{--<span class="text">
                              codigo
                        </span>--}}

                        <!-- Emphasis label -->
                        <small class="text text-uppercase" style="cursor: pointer;">
                            <span class="d-none d-md-inline" wire:click="show('{{ $bien->rowquid }}')">
                                {{ $bien->verTipo }}
                                {{ $bien->verMarca }}
                                {{ $bien->verModelo }}
                                @if(!is_null($bien->serial))
                                    , Serial: <span class="text-nowrap">{{ $bien->serial }}</span>
                                @endif
                                @if(!is_null($bien->identificador))
                                    , Identificador: <span class="text-nowrap">{{ $bien->identificador }}</span>
                                @endif
                            </span>

                            <span class="d-md-none" wire:click="showHide('{{ $bien->rowquid }}')">
                                {{ $bien->verTipo }}
                                {{ $bien->verMarca }}
                                {{ $bien->verModelo }}
                                @if(!is_null($bien->serial))
                                    , Serial: <span class="text-nowrap">{{ $bien->serial }}</span>
                                @endif
                                @if(!is_null($bien->identificador))
                                    , Identificador: <span class="text-nowrap">{{ $bien->identificador }}</span>
                                @endif
                            </span>
                        </small>

                        <!-- General tools such as edit or delete-->
                        <div class="tools text-lightblue" wire:click="show('{{ $bien->rowquid }}')">
                            <i class="d-none d-md-inline fas fa-eye"></i>
                        </div>

                        <div class="tools text-lightblue d-md-none" wire:click="showHide('{{ $bien->rowquid }}')">
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

    <div style="z-index: 1025;">
        {!! verSpinner('setLimit, actualizar, cerrarBusqueda, showHide, createHide') !!}
    </div>

</div>



