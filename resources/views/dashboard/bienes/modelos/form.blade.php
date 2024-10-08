<div class="card card-navy">

    <div class="card-header">
        @if($modelos_id)
            <h3 class="card-title">Editar</h3>
        @else
            <h3 class="card-title">Crear</h3>
        @endif
        <div class="card-tools">
            <button type="button" class="btn btn-tool d-none d-md-inline" wire:click="limpiarModelos">
                <i class="fas fa-ban"></i> Cancelar
            </button>
            <button type="button" class="btn btn-tool d-md-none" wire:click="btnCancelar('true')">
                <i class="fas fa-ban"></i> Cancelar
            </button>
        </div>
    </div>

    <div class="card-body">


        <form wire:submit="save">

            <div class="form-group">
                <label for="name">Tipo</label>
                <div wire:ignore>
                    <div class="input-group mb-3" id="div_select_modelos_tipo">
                        {{--JS--}}
                    </div>
                </div>
                @error('tipos_id')
                <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Marca</label>
                <div wire:ignore>
                    <div class="input-group mb-3" id="div_select_modelos_marca">
                        {{--JS--}}
                    </div>
                </div>
                @error('marcas_id')
                <span class="col-sm-12 text-sm text-bold text-danger">
                        <i class="icon fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Modelo</label>
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
                <button type="submit" class="btn btn-block @if($modelos_id) btn-primary @else btn-success @endif"
                        @if(!comprobarPermisos('modelos.create') || ($modelos_id && !comprobarPermisos('modelos.edit'))) disabled @endif >
                    <i class="fas fa-save"></i>
                    Guardar
                    @if($modelos_id)
                        Cambios
                    @endif
                </button>
            </div>

        </form>


    </div>

    {{--{!! verSpinner() !!}--}}

</div>
