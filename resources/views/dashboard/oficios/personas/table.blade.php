<div class="card card-navy">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                @if(!$filtro)
                    Búsqueda { <b class="text-warning">{{ $keyword }}</b> }
                @else
                    Filtro { <b class="text-warning text-capitalize">{{ $filtro }}</b> }
                @endif
                [ <b class="text-warning">{{ $rowsCount }}</b> ]
                <button class="btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Registrados [ <b class="text-warning">{{ $totalRows }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="limpiarPersonas">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool" wire:click="create"
                    @if(!comprobarPermisos('personas.create')) disabled @endif>
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($disable) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 47vh;">
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th style="width: 40%;">Nombre</th>
                <th class="d-none d-md-table-cell">Cargo</th>
                <th class="d-none d-md-table-cell">Institución</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($listarRows->isNotEmpty())
                @foreach($listarRows as $row)
                    <tr>
                        <td class="text-uppercase text-capitalize" style="max-width: 150px;">{{ $row->prefijo }} {{ $row->nombre }}</td>
                        <td class="d-none d-md-table-cell text-capitalize text-truncate" style="max-width: 150px;">
                            @if($row->cargo)
                                {{ $row->cargo }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="d-none d-md-table-cell text-capitalize text-truncate" style="max-width: 150px;">
                            @if($row->instituciones_id)
                                {{ $row->institucion->nombre }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="justify-content-end">
                            <div class="btn-group">
                                <button wire:click="edit('{{ $row->rowquid }}')" class="btn btn-primary btn-sm"
                                        @if(!comprobarPermisos('personas.edit')) disabled @endif >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="destroy('{{ $row->rowquid }}')" class="btn btn-primary btn-sm"
                                        @if(!comprobarPermisos('personas.destroy')) disabled @endif >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="4">
                        @if($keyword)
                            <span>Sin resultados.</span>
                        @else
                            <span>Aún no se han creado registros.</span>
                        @endif
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <small>Mostrando {{ $listarRows->count() }}</small>
    </div>
</div>
