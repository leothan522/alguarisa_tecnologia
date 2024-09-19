<div class="card card-navy">

    <div class="card-header">
        @if($instituciones_id)
            <h3 class="card-title">Editar</h3>
        @else
            <h3 class="card-title">Crear</h3>
        @endif
        <div class="card-tools">
            <button class="btn btn-tool" wire:click="limpiarInstituciones">
                <i class="fas fa-ban"></i> Cancelar
            </button>
        </div>
    </div>

    <div class="card-body">


        <form wire:submit="save">

            <div class="form-group">
                <label for="name">Nombre</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model="nombre" placeholder="Nombre">
                    @error('nombre')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-block @if($instituciones_id) btn-primary @else btn-success @endif"
                        @if(!comprobarPermisos('instituciones.create') || ($instituciones_id && !comprobarPermisos('instituciones.edit'))) disabled @endif >
                    <i class="fas fa-save"></i>
                    Guardar
                    @if($instituciones_id)
                        Cambios
                    @endif
                </button>
            </div>

        </form>

    </div>

</div>
