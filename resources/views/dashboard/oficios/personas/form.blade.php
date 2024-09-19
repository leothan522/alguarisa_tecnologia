<div class="card card-navy">

    <div class="card-header">
        @if($personas_id)
            <h3 class="card-title">Editar</h3>
        @else
            <h3 class="card-title">Crear</h3>
        @endif
        <div class="card-tools">
            <button class="btn btn-tool" wire:click="limpiarPersonas">
                <i class="fas fa-ban"></i> Cancelar
            </button>
        </div>
    </div>

    <div class="card-body">


        <form wire:submit="save">

            <div class="form-group">
                <label for="name">Prefijo</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model="prefijo" placeholder="[Lcdo.] [Lcda.] [Ing.] (Opcional)">
                    @error('prefijo')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name">Nombre</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model="nombre" placeholder="Nombre Completo">
                    @error('nombre')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name">Cargo</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <input type="text" class="form-control" wire:model="cargo" placeholder="Cargo (Opcional)">
                    @error('cargo')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="name">Institución</label>
                <div wire:ignore>
                    <div class="input-group mb-3" id="div_select_personas_institucion">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <select class="form-control">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                </div>
                @error('cargo')
                    <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Sexo</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <select class="custom-control custom-select" wire:model="sexo">
                        <option value="">Seleccione</option>
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                    </select>
                    @error('sexo')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-block @if($personas_id) btn-primary @else btn-success @endif"
                        @if(!comprobarPermisos('personas.create') || ($personas_id && !comprobarPermisos('personas.edit'))) disabled @endif >
                    <i class="fas fa-save"></i>
                    Guardar
                    @if($personas_id)
                        Cambios
                    @endif
                </button>
            </div>

        </form>

    </div>

</div>
