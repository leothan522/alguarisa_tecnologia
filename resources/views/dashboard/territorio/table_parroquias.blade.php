<div id="div_table_parroquias" class="card card-navy card-outline">

    <div class="card-header">

        <h3 class="card-title mb-2 mb-sm-auto">
            @if($keywordParroquias || $idMunicipio)
                @if($idMunicipio)
                    Filtrando
                    <span class="text-nowrap">{ <b class="text-warning">{{ $verMunicipio }}</b> }</span>
                @else
                    Búsqueda
                    <span class="text-nowrap">{ <b class="text-warning">{{ $keywordParroquias }}</b> }</span>
                @endif
                <span class="text-nowrap">[ <b class="text-warning">{{ $rowsParroquias }}</b> ]</span>
                <button class="d-sm-none btn btn-tool text-warning" wire:click="cerrarBusquedaParroquias">
                    <i class="fas fa-times"></i>
                </button>
            @else
                Parroquias [ <b class="text-warning">{{ $rowsParroquias }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            @if($keywordParroquias || $idMunicipio)
                <button class="d-none d-sm-inline-block btn btn-tool text-warning" wire:click="cerrarBusquedaParroquias">
                    <i class="fas fa-times"></i>
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button class="btn btn-tool" data-toggle="modal" data-target="#modal-default-parroquias" wire:click="formParroquias">
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimitParroquias" @if($btnDisabledParroquias) disabled @endif >
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
                <th class="d-none d-lg-table-cell text-uppercase text-right pr-3">Familias</th>
                <th class="d-none d-xl-table-cell text-uppercase text-center">Mun.</th>
                <th class="text-center" style="width: 5%;"><small>Rows {{ $listarParroquias->count() }}</small></th>
            </tr>
            </thead>
            <tbody id="tbody_parroquias" wire:loading.class="invisible" wire:target="actualizar, cerrarBusquedaParroquias, setLimitParroquias, filtrar">
            @if($listarParroquias->isNotEmpty())
                @php($i = 0)
                @foreach($listarParroquias as $parroquia)
                    <tr>
                        <td class="align-middle text-bold text-center">{{ ++$i }}</td>
                        <td class="align-middle d-table-cell text-uppercase text-truncate" style="max-width: 150px;">{{ $parroquia->nombre }}</td>
                        <td class="align-middle d-none d-lg-table-cell text-right pr-3">{{ formatoMillares($parroquia->familias, 0) }}</td>
                        <td class="align-middle d-none d-xl-table-cell text-uppercase text-center">{{ $parroquia->municipio->mini }}</td>
                        <td class="justify-content-end">

                            <div class="btn-group d-lg-none">
                                <button wire:click="editParroquias('{{ $parroquia->rowquid }}')" class="btn btn-primary"
                                        data-toggle="modal" data-target="#modal-show-parroquias">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <div class="btn-group d-none d-lg-flex">


                                <button wire:click="setEstatusParroquia('{{ $parroquia->rowquid }}')" class="btn btn-primary btn-sm">
                                    @if($parroquia->estatus)
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas fa-ban"></i>
                                    @endif
                                </button>

                                <button wire:click="editParroquias('{{ $parroquia->rowquid }}')" class="btn btn-primary btn-sm"
                                        data-toggle="modal" data-target="#modal-default-parroquias">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button onclick="confirmToastBootstrap('destroyParroquia',  { rowquid: '{{ $parroquia->rowquid }}' })"
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
        <small>Mostrando {{ $listarParroquias->count() }}</small>
    </div>

    {!! verSpinner('actualizar, cerrarBusquedaParroquias, setLimitParroquias, setEstatusParroquia, filtrar') !!}

</div>
