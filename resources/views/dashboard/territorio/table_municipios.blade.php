<div id="div_table_parametros" class="card card-navy card-outline">
    <div class="card-header">
        <h3 class="card-title">
            @if($keywordMunicipios)
                Búsqueda { <b class="text-primary">{{ $keywordMunicipios }}</b> } [ <b class="text-primary">{{ $rowsMunicipios }}</b> ]
                <button class="btn btn-tool text-danger" wire:click="cerrarBusqueda"><i class="fas fa-times-circle"></i>
                </button>
            @else
                Municipios [ <b class="text-primary">{{ $rowsMunicipios }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-default" wire:click="limpiar">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit('municipios')" @if($listarMunicipios->count() >= $rowsMunicipios) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" @if(/*$tableStyle*/true) style="height: 67vh;" @endif >
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th class="text-center" style="width: 5%">#</th>
                <th>Nombre</th>
                <th class="d-none d-md-table-cell text-center" style="width: 5%">Parroquias</th>
                <th class="d-none d-md-table-cell text-right pr-3">Familias</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($listarMunicipios->isNotEmpty())
                @foreach($listarMunicipios as $municipio)
                    <tr>
                        <td class="text-bold text-center">1</td>
                        <td class="d-table-cell text-truncate" style="max-width: 150px;">{{ $municipio->nombre  }}</td>
                        <td class="d-none d-md-table-cell text-center">{{ $municipio->parroquias }}</td>
                        <td class="d-none d-md-table-cell text-right pr-3">{{ formatoMillares($municipio->familias, 0) }}</td>
                        <td class="justify-content-end">
                            <div class="btn-group">
                                <button {{--wire:click="edit('{{ $parametro->rowquid }}')"--}} class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button {{--wire:click="destroy('{{ $parametro->rowquid }}')"--}} class="btn btn-primary btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="5">
                        @if($keywordMunicipios)
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
        <small>Mostrando {{ $listarMunicipios->count() }}</small>
    </div>

    {!! verSpinner() !!}

</div>
