<div wire:ignore.self class="modal fade" id="modal-oficios">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">

                    <div class="col-md-6">
                        <h4 class="modal-title">
                            Oficios Entregados
                        </h4>
                    </div>

                    <div class="col-md-6 justify-content-end">
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

                </div>

                <button type="button" class="float-right close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <div class=" @if(!$view) d-none @endif ">
                    @include('dashboard.bienes.oficios.table')
                </div>

                <div @if(!$form) class="d-none" @endif >
                    @include('dashboard.bienes.oficios.form')
                </div>

            </div>

            <div class="modal-footer @if(($keyword && $view)) justify-content-between @else justify-content-end @endif ">
                @if($keyword && $view)
                    <span>Resultados [<b class="text-warning">{{ $total }}</b>]</span>
                @endif
                @if($cancelar)
                    <button type="button" wire:click="btnCancelar" class="btn btn-default btn-sm d-md-none">
                        <i class="fas fa-ban"></i> Cancelar
                    </button>
                @endif
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btn_cerrar_model_oficios">{{ __('Close') }}</button>
            </div>

            {!! verSpinner() !!}

        </div>
    </div>
</div>
