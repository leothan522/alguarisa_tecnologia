<div id="div_table_parametros" class="card card-navy card-outline">
    <div class="card-header">
        <h3 class="card-title">
            @if($keywordParroquias)
                Búsqueda { <b class="text-primary">{{ $keywordParroquias }}</b> } [ <b class="text-primary">{{ $rowsParroquias }}</b> ]
                <button class="btn btn-tool text-danger" wire:click="cerrarBusqueda"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Parroquias [ <b class="text-primary">{{ $rowsParroquias }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-default" wire:click="limpiar">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if(/*($rows >= $rowsParametros) || $rows > $totalBusqueda*/false) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" @if($tableStyle) style="height: 67vh;" @endif >
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th class="text-center" style="width: 5%">#</th>
                <th>Nombre</th>
                <th class="d-none d-md-table-cell">Municipio</th>
                <th class="d-none d-md-table-cell text-right">Familias</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if(/*$parametros->isNotEmpty()*/false)
                @foreach($parametros as $parametro)
                    <tr>
                        <td class="text-bold text-center">{{ $parametro->id }}</td>
                        <td class="d-table-cell text-truncate" style="max-width: 150px;">{{ $parametro->nombre }}</td>
                        <td class="d-none d-md-table-cell">
                            @if(is_null($parametro->tabla_id))
                                null
                            @else
                                {{ $parametro->tabla_id }}
                            @endif
                        </td>
                        <td class="d-none d-md-table-cell text-truncate" style="max-width: 150px;">
                            @if(is_null($parametro->valor))
                                null
                            @else
                                @if($parametro->tabla_id == "-1")
                                    json{...}
                                @else
                                    {{ $parametro->valor }}
                                @endif
                            @endif
                        </td>
                        <td class="justify-content-end">
                            <div class="btn-group">
                                <button wire:click="edit('{{ $parametro->rowquid }}')" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="destroy('{{ $parametro->rowquid }}')" class="btn btn-primary btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="5">
                        @if($keywordParroquias)
                            <span>Sin resultados</span>
                        @else
                            <span>Sin registros guardados</span>
                        @endif
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <small>Mostrando 0{{--{{ $parametros->count() }}--}}</small>
    </div>

    {!! verSpinner() !!}

</div>
