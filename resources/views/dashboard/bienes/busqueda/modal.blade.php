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
                        <form wire:submit="initBusqueda">

                            <div class="form-group">
                                <label for="name">Tipo</label>
                                <div wire:ignore>
                                    <div class="input-group mb-3" id="div_select_busqueda_tipo">
                                        {{--JS--}}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Marca</label>
                                <div wire:ignore>
                                    <div class="input-group mb-3" id="div_select_busqueda_marca">
                                        {{--JS--}}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Modelo</label>
                                <div wire:ignore>
                                    <div class="input-group mb-3" id="div_select_busqueda_modelo">
                                        {{--JS--}}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Color</label>
                                <div wire:ignore>
                                    <div class="input-group mb-3" id="div_select_busqueda_color">
                                        {{--JS--}}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Condición</label>
                                <div wire:ignore>
                                    <div class="input-group mb-3" id="div_select_busqueda_condicion">
                                        {{--JS--}}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-group-sm">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Serial
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-group-sm" wire:model="serial" placeholder="(Opcional)">
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
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

