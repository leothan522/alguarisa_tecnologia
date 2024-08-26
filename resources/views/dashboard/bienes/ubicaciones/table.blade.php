<div class="card card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda { <b class="text-warning">{{ $keyword }}</b> } [ <b class="text-warning">{{ $totalBusqueda }}</b> ]
                <button class="btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Registradas [ <b class="text-warning">{{ $rowsUbicaciones }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="limpiarUbicaciones">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button type="button" class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('ubicaciones.create')) disabled @endif>
                <i class="fas fa-file"></i> Nuevo
            </button>
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if(($rows > $rowsUbicaciones) || ($keyword && $rows > $totalBusqueda)) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 47vh;">
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Nombre</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($listarUbicaciones->isNotEmpty())
                @foreach($listarUbicaciones as $ubicacion)
                    <tr>
                        <td class="text-uppercase text-truncate" style="max-width: 150px;">{{ $ubicacion->nombre }}</td>
                        <td class="justify-content-end">
                            <div class="btn-group">
                                <button wire:click="edit({{ $ubicacion->id }})" class="btn btn-primary btn-sm"
                                @if(!comprobarPermisos('ubicaciones.edit')) disabled @endif >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="destroy({{ $ubicacion->id }})" class="btn btn-primary btn-sm"
                                @if(!comprobarPermisos('ubicaciones.destroy')) disabled @endif >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @else
                <tr class="text-center">
                    <td colspan="2">
                        @if($keyword)
                            <span>Sin resultados.</span>
                        @else
                            <span>Aún se se ha creado una Ubicación.</span>
                        @endif
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <small>Mostrando {{ $listarUbicaciones->count() }}</small>
    </div>
</div>
