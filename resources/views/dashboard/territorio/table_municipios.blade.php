<div id="div_table_municipios" class="card card-navy card-outline">

    <div class="card-header">

        <h3 class="card-title mb-2 mb-sm-auto">
            @if($keywordMunicipios)
                Búsqueda
                <span class="text-nowrap">{ <b class="text-warning">{{ $keywordMunicipios }}</b> }</span>
                <span class="text-nowrap">[ <b class="text-warning">{{ $rowsMunicipios }}</b> ]</span>
                <button class="d-sm-none btn btn-tool text-warning" wire:click="cerrarBusquedaMunicipios">
                    <i class="fas fa-times"></i>
                </button>
            @else
                Municipios [ <b class="text-warning">{{ $rowsMunicipios }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            @if($keywordMunicipios)
                <button class="d-none d-sm-inline-block btn btn-tool text-warning" wire:click="cerrarBusquedaMunicipios">
                    <i class="fas fa-times"></i>
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-default-municipios" wire:click="limpiar">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimitMunicipios" @if($btnDisabledMunicipios) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>

    </div>

    <div class="card-body table-responsive p-0" style="max-height: calc(100vh - {{ $size }}px)">
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-lightblue">
                <th class="text-center text-uppercase" style="width: 5%">#</th>
                <th class="text-uppercase">Nombre</th>
                <th class="d-none d-md-table-cell text-uppercase text-center">Pq.</th>
                <th class="d-none d-md-table-cell text-uppercase text-right pr-3">Familias</th>
                <th class="text-center" style="width: 5%;"><small>Rows {{ $listarMunicipios->count() }}</small></th>
            </tr>
            </thead>
            <tbody id="tbody_municipios" wire:loading.class="invisible" wire:target="actualizar, cerrarBusquedaMunicipios, setLimitMunicipios">
            @if($listarMunicipios->isNotEmpty())
                @php($i = 0)
                @foreach($listarMunicipios as $municipio)
                    <tr>
                        <td class="align-middle text-bold text-center">{{ ++$i }}</td>
                        <td class="align-middle d-table-cell text-uppercase text-truncate" style="max-width: 150px;">{{ $municipio->nombre }}</td>
                        <td class="d-none d-md-table-cell text-center">
                            <div class="btn-group">
                                <button wire:click="filtrar('{{ $municipio->rowquid }}')" class="btn btn-outline-success btn-sm text-bold">
                                    {{ formatoMillares($municipio->parroquias, 0) }}
                                </button>
                            </div>
                        </td>
                        <td class="align-middle d-none d-md-table-cell text-right pr-3">{{ formatoMillares($municipio->familias, 0) }}</td>
                        <td class="justify-content-end">

                            <div class="btn-group d-md-none">
                                <button wire:click="editMunicipios('{{ $municipio->rowquid }}')" class="btn btn-primary"
                                        data-toggle="modal" data-target="#modal-show-municipios">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <div class="btn-group d-none d-md-flex">


                                <button wire:click="setEstatusMunicipio('{{ $municipio->rowquid }}')" class="btn btn-primary btn-sm">
                                    @if($municipio->estatus)
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas fa-ban"></i>
                                    @endif
                                </button>

                                <button wire:click="editMunicipios('{{ $municipio->rowquid }}')" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#modal-default-municipios">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button onclick="confirmToastBootstrap('destroyMunicipio',  { rowquid: '{{ $municipio->rowquid }}' })"
                                        class="btn btn-primary btn-sm">
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

    {!! verSpinner('actualizar, cerrarBusquedaMunicipios, setLimitMunicipios, setEstatusMunicipio') !!}

</div>
