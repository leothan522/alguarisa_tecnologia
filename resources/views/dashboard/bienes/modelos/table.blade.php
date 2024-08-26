<div class="card card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda { <b class="text-warning">{{ $keyword }}</b> } [ <b class="text-warning">{{ $totalBusqueda }}</b> ]
                <button class="btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Registrados [ <b class="text-warning">{{ $rowsModelos }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="limpiarModelos">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('modelos.create')) disabled @endif>
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if(($rows > $rowsModelos) || ($keyword && $rows > $totalBusqueda)) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 47vh;">
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Modelo</th>
                <th class="d-none d-md-table-cell">Tipo</th>
                <th class="d-none d-md-table-cell">Marca</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($listarModelos->isNotEmpty())
                @foreach($listarModelos as $modelo)
                    <tr>
                        <td class="text-uppercase text-truncate" style="max-width: 150px;">{{ $modelo->nombre }}</td>
                        <td class="text-uppercase text-truncate d-none d-md-table-cell" style="max-width: 150px;">{{ $modelo->tipo->nombre }}</td>
                        <td class="text-uppercase text-truncate d-none d-md-table-cell" style="max-width: 150px;">{{ $modelo->marca->nombre }}</td>
                        <td class="justify-content-end">
                            <div class="d-none d-md-block">
                                <div class="btn-group">
                                    <button type="button" wire:click="edit({{ $modelo->id }})" class="btn btn-primary btn-sm"
                                            @if(!comprobarPermisos('modelos.edit')) disabled @endif >
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button type="button" wire:click="destroy({{ $modelo->id }})" class="btn btn-primary btn-sm"
                                            @if(!comprobarPermisos('modelos.destroy')) disabled @endif >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-md-none">
                                <div class="btn-group">
                                    <button type="button" wire:click="verModel({{ $modelo->id }})" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
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
                            <span>Aún se se ha creado un Modelo.</span>
                        @endif
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <small>Mostrando {{ $listarModelos->count() }}</small>
    </div>
</div>
