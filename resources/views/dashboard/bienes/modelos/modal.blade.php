<div wire:ignore.self class="modal fade" id="modal-modelos" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row col-md-10">

                    <div class="col-md-6">
                        <h4 class="modal-title">
                            Modelos
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

                <button type="button" wire:click="limpiarModelos" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">

                <div class="row justify-content-center">
                    <div class="col-md-6 @if(!$form) d-none @endif ">
                        @include('dashboard.bienes.modelos.form')
                    </div>
                    <div class="col-12 @if(!$table) d-none @endif ">
                        @include('dashboard.bienes.modelos.table')
                    </div>
                    <div class="col-12 @if(!$show) d-none @endif ">
                        @include('dashboard.bienes.modelos.show')
                    </div>
                </div>

            </div>

            {!! verSpinner() !!}

            <div class="modal-footer @if($show) justify-content-between @else justify-content-end @endif ">
                @if($show)
                    <button type="button" class="btn btn-danger btn-sm" wire:click="destroy({{ $modelos_id }})">
                        <i class="fas fa-trash-alt"></i>
                    </button>

                    <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $modelos_id }})">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                @endif
                <button type="button" wire:click="limpiarModelos" class="btn btn-default btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>

        </div>
    </div>
</div>
