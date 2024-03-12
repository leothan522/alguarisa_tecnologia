<div class="card card-navy" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;"
     xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        @if($condiciones_id)
            <h3 class="card-title">Editar</h3>
        @else
            <h3 class="card-title">Crear</h3>
        @endif
        <div class="card-tools">
            <button class="btn btn-tool" wire:click="limpiarCondiciones">
                @if($errors->all() || $condiciones_id)
                    <i class="fas fa-ban"></i> Cancelar
                @else
                    <i class="fas fa-file"></i>
                @endif
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
                <button type="submit" class="btn btn-block @if($condiciones_id) btn-primary @else btn-success @endif"
                @if(!comprobarPermisos('condiciones.create') || ($condiciones_id && !comprobarPermisos('condiciones.edit'))) disabled @endif >
                    <i class="fas fa-save"></i> Guardar @if($condiciones_id) Cambios @endif
                </button>
            </div>

        </form>




    </div>

    {{--{!! verSpinner() !!}--}}

</div>
