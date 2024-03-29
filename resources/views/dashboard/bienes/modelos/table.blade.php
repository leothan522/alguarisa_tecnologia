<div class="card card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Resultados de la Busqueda { <b class="text-warning">{{ $keyword }}</b> }
                <button class="btn btn-tool text-warning" wire:click="limpiarModelos">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Modelos Registrados [ <b class="text-warning">{{ $rowsModelos }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" wire:click="setLimit" @if($rows > $rowsModelos) disabled @endif >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0" style="height: 47vh;">
        <table class="table table-sm table-head-fixed table-hover text-nowrap">
            <thead>
            <tr class="text-navy">
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th style="width: 5%;">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @if($listarModelos->isNotEmpty())
                @foreach($listarModelos as $modelo)
                    <tr>
                        <td>{{ $modelo->tipo->nombre }}</td>
                        <td>{{ $modelo->marca->nombre }}</td>
                        <td>{{ $modelo->nombre }}</td>
                        <td class="justify-content-end">
                            <div class="btn-group">
                                <button wire:click="edit({{ $modelo->id }})" class="btn btn-primary btn-sm"
                                @if(!comprobarPermisos('modelos.edit')) disabled @endif >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button wire:click="destroy({{ $modelo->id }})" class="btn btn-primary btn-sm"
                                @if(!comprobarPermisos('modelos.destroy')) disabled @endif >
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
