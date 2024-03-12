<form wire:submit="save" xmlns:wire="http://www.w3.org/1999/xhtml">

<div class="row">

        <div class="col-md-6">

            <div class="card card-outline card-navy">

                <div class="card-header">
                    <h5 class="card-title">Datos Básicos</h5>
                    <div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-book"></i></span>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="email">Tipo:</label>
                        <div wire:ignore>
                            <div class="input-group mb-3" id="div_select_categorias">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                                </div>
                                <select class="custom-select">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        @error('categorias_id')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Marca:</label>
                        <div wire:ignore>
                            <div class="input-group mb-3" id="div_select_procedencias">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                                </div>
                                <select class="custom-select">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        @error('procedencias_id')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Modelo:</label>
                        <div wire:ignore>
                            <div class="input-group mb-3" id="div_select_procedencias">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                                </div>
                                <select class="custom-select">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        @error('procedencias_id')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Color:</label>
                        <div wire:ignore>
                            <div class="input-group mb-3" id="div_select_procedencias">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                                </div>
                                <select class="custom-select">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        @error('procedencias_id')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card card-outline card-navy">
                <div class="card-header">
                    <h5 class="card-title">Datos Especificos</h5>
                    <div class="card-tools">
                        <span class="btn-tool"><i class="fas fa-book"></i></span>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="email">Serial:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model="serial" placeholder="Serial">
                            @error('serial')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name">Identificador:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model="identificador" placeholder="alfanumérico">
                            @error('identificador')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Estatus:</label>
                        <div wire:ignore>
                            <div class="input-group mb-3" id="div_select_procedencias">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                                </div>
                                <select class="custom-select">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                        @error('procedencias_id')
                        <span class="col-sm-12 text-sm text-bold text-danger">
                            <i class="icon fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Información Adicional:</label>
                        <div class="input-group">
                            <textarea class="form-control" wire:model="adicional" placeholder="Información Adicional (Opcional)"></textarea>
                            @error('adicional')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

        </div>
</div>

<div class="row justify-content-end">
        <div class="col-md-4">
            <button type="submit" class="btn btn-block @if(/*$nuevo*/true) btn-success @else btn-primary @endif float-right mr-1"
                    @if(!comprobarPermisos('articulos.create')) disabled @endif >
                <i class="fas fa-save"></i> Guardar @if(/*$editar*/false) Cambios @endif
            </button>
        </div>
    </div>
</form>
