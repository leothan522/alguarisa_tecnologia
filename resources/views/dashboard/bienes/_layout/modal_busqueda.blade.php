<div wire:ignore.self class="modal fade" id="modal-busqueda-avanzada" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Busqueda Avanzada</h5>
                <button type="button" {{--wire:click="limpiar()"--}} class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form wire:submit="busqueda">
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Tipo
                                        </span>
                                    </div>
                                    <select class="form-control form-control-sm" name="nivel">
                                        <option value="all"></option>
                                    </select>
                                    @error('stock')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Marca
                                        </span>
                                    </div>
                                    <select class="form-control form-group-sm" name="tipo">
                                        <option value="all"></option>
                                    </select>
                                    @error('tipo')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Modelo
                                        </span>
                                    </div>
                                    <select class="form-control form-group-sm" name="unidad">
                                        <option value="all"></option>
                                        {{--@foreach($listarUnidades as $key => $valor)
                                            <option value="{{ $key }}">{{ $valor }}</option>
                                        @endforeach--}}
                                    </select>
                                    @error('unidad')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Color
                                        </span>
                                    </div>
                                    <select class="form-control form-group-sm" name="unidad">
                                        <option value="all"></option>
                                        {{--@foreach($listarUnidades as $key => $valor)
                                            <option value="{{ $key }}">{{ $valor }}</option>
                                        @endforeach--}}
                                    </select>
                                    @error('unidad')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Condición
                                        </span>
                                    </div>
                                    <select class="form-control form-group-sm" name="unidad">
                                        <option value="all"></option>
                                        {{--@foreach($listarUnidades as $key => $valor)
                                            <option value="{{ $key }}">{{ $valor }}</option>
                                        @endforeach--}}
                                    </select>
                                    @error('unidad')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Serial
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-group-sm">
                                    @error('unidad')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Identificador
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-group-sm">
                                    @error('unidad')
                                    <span class="col-sm-12 text-sm text-bold text-danger">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <i class="fas fa-search"></i>
                                    Generar Busqueda
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            {!! verSpinner() !!}

            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="cerrar_busqueda_avanzada">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>

