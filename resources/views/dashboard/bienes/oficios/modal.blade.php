<div wire:ignore.self class="modal fade" id="modal-oficios" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row col-md-12">

                    <div class="col-md-6">
                        <h4 class="modal-title">
                            Oficios Entregados
                        </h4>
                    </div>
                    <div class="col-md-5 justify-content-end">
                        <form wire:submit="buscar">
                            <div class="input-group close">
                                <input type="search" class="form-control" placeholder="Buscar" wire:model="keyword" required>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
            <div class="modal-body">

                <div class=" @if(!$view) d-none @endif ">
                    @include('dashboard.bienes.oficios.table')
                </div>

                <div @if(!$form) class="d-none" @endif >
                    @include('dashboard.bienes.oficios.form')
                </div>

            </div>

            {!! verSpinner() !!}

            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btn_cerrar_model_oficios">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
