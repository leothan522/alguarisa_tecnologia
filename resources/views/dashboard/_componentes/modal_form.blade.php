<form wire:submit="save">
    <div wire:ignore.self class="modal fade" id="modal-default">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title">
                        @if($view == "create")
                            Crear Parametro
                        @else
                            Editar Parametro
                        @endif
                    </h4>
                    <button type="button" {{--wire:click="limpiar()"--}} class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <small class="text-bold">Nombre:</small>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model="nombre" name="nombre" placeholder="Nombre">
                            @error('nombre')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-bold">tabla_id:</small>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model="tabla_id" name="tabla_id" placeholder="tabla_id">
                            @error('tabla_id')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-bold">valor:</small>
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model="valor" name="valor" placeholder="valor">
                            @error('valor')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                    <button type="submit" class="btn  @if($view == "edit") btn-primary @else btn-success @endif ">
                        Guardar @if($view == "edit") Cambios @endif
                    </button>

                </div>

                {!! verSpinner() !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

