<form wire:submit="initBusqueda">
    <div wire:ignore.self class="modal fade" id="modal-busqueda-avanzada">
        <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-navy">
                    <h5 class="modal-title">Búsqueda Avanzada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="div_modal_busqueda_body" wire:loading.class="invisible" wire:target="initBusqueda">

                    <div class="row justify-content-center">
                        <div class="col-12">

                            <div class="form-group">
                                <small class="text-lightblue text-bold text-uppercase">Tipo:</small>
                                <div wire:ignore>
                                    <div id="div_select_busqueda_tipo" class="input-group">
                                        <select class="custom-select">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                @error('tipo')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <small class="text-lightblue text-bold text-uppercase">Marca:</small>
                                <div wire:ignore>
                                    <div id="div_select_busqueda_marca" class="input-group">
                                        <select class="custom-select">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                @error('marca')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <small class="text-lightblue text-bold text-uppercase">Modelo:</small>
                                <div wire:ignore>
                                    <div id="div_select_busqueda_modelo" class="input-group">
                                        <select class="custom-select">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                @error('modelo')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <small class="text-lightblue text-bold text-uppercase">Color:</small>
                                <div wire:ignore>
                                    <div id="div_select_busqueda_color" class="input-group">
                                        <select class="custom-select">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                @error('color')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <small class="text-lightblue text-bold text-uppercase">Condición:</small>
                                <div wire:ignore>
                                    <div id="div_select_busqueda_condicion" class="input-group">
                                        <select class="custom-select">
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                </div>
                                @error('condicion')
                                <small class="text-danger text-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group form-group-sm d-none">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Serial
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-group-sm" wire:model="serial" placeholder="(Opcional)">
                                </div>
                            </div>

                            <div class="form-group form-group-sm d-none">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Identificador
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-group-sm" wire:model="identificador" placeholder="(Opcional)">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <i class="fas fa-search"></i>
                                    Generar Busqueda
                                </button>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" wire:click="limpiarBusqueda">
                        <i class="fas fa-redo"></i> Limpiar
                    </button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="cerrar_busqueda_avanzada">{{ __('Close') }}</button>
                </div>

                {!! verSpinner() !!}

            </div>
        </div>
    </div>
</form>

