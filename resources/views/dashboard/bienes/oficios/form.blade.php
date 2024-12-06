<form wire:submit="save">

    <div class="row">

        <div class="col-12">

            <div class="card @if(!$ver) card-outline @endif card-navy">

                <div class="card-header">
                    <h5 class="card-title">
                        @if($nuevo)
                            Registrar
                        @endif
                        @if($ver)
                            Ver
                        @endif
                        @if(!$editar && $cancelar && !$nuevo)
                            Editar
                        @endif
                        Oficios
                    </h5>
                    <div class="card-tools text-center">
                        {{--<span class="btn-tool"><i class="fas fa-book"></i></span>--}}
                        @if($editar)
                            <button type="button" class="btn btn-tool" wire:click="destroy"
                                    @if(!comprobarPermisos('oficios.destroy')) disabled @endif >
                                <i class="fa fa-trash-alt"></i> Eliminar
                            </button>
                        @endif
                        @if(!$nuevo)
                            <button type="button" class="btn btn-tool" wire:click="create"
                                    @if(!comprobarPermisos('oficios.create')) disabled @endif >
                                <i class="fas fa-file"></i> Nuevo
                            </button>
                        @endif
                        @if($editar)
                            <button type="button" class="btn btn-tool" wire:click="edit"
                                    @if(!comprobarPermisos('oficios.edit')) disabled @endif >
                                <i class="fa fa-edit"></i> Editar
                            </button>
                        @endif
                        @if($cancelar)
                            <button type="button" class="btn btn-tool d-none d-md-inline" wire:click="btnCancelar">
                                <i class="fas fa-ban"></i> Cancelar
                            </button>
                        @endif
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Nro. Oficio:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                                    </div>
                                    <input type="text" class="form-control" wire:model="oficio" placeholder="Nro. Oficio" @if($ver) readonly @endif >
                                    @error('oficio')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                @error('oficio')
                                <div class="form-check m-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:click="btnRepetido">
                                    <label class="form-check-label" for="exampleCheck1">Repetido</label>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Fecha:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                                    </div>
                                    <input type="date" class="form-control" wire:model="fecha" placeholder="alfanumérico" @if($ver) readonly @endif >
                                    @error('fecha')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!$ver)
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{--<label for="email">Nro. Oficio:</label>--}}
                                    <div class="input-group">
                                        <input type="text" class="form-control" wire:model="serial" wire:keydown.enter="btnSerial" placeholder="Serial ó Identificador">
                                        <div class="input-group-append">
                                            <button type="button" class="input-group-text" wire:click="btnSerial">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        @error('serial')
                                        <span class="col-sm-12 text-sm text-bold text-danger">
                                            <i class="icon fas fa-exclamation-triangle"></i>
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        @include('dashboard.bienes.oficios.bienes')
                    </div>


                    @if(!$ver || $adicional)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{--<label for="email">Nro. Oficio:</label>--}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-bookmark"></i>
                                            {{--Información Adicional--}}
                                        </span>
                                        </div>
                                        <input type="text" class="form-control" wire:model="adicional"
                                               placeholder="Información Adicional (Opcional)"
                                               @if($ver) readonly @endif >
                                        {{--<textarea class="form-control" wire:model="adicional" placeholder="Información Adicional (Opcional)"></textarea>--}}
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
                    @endif

                </div>

            </div>

        </div>

    </div>

    <div class="row justify-content-end @if($ver) d-none @endif ">
        <div class="col-md-4 m-1">
            <button type="submit" class="btn btn-block @if($nuevo) btn-success @else btn-primary @endif float-right">
                <i class="fas fa-save"></i>
                Guardar
                @if(!$nuevo)
                    Cambios
                @endif
            </button>
        </div>
    </div>

</form>
