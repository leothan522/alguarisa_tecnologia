<form wire:submit="saveParroquias">
    <div wire:ignore.self class="modal fade" id="modal-default-parroquias">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title" wire:loading.class="invisible" wire:target="formParroquias, editParroquias">
                        @if($parroquias_id)
                            Editar
                        @else
                            Crear
                        @endif
                            Parroquia
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" wire:loading.class="invisible" wire:target="formParroquias, editParroquias, saveParroquias">

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Municipio:</small>
                        <div id="form_parroquias_div_select" class="input-group" style="min-height: 38px;" wire:ignore></div>
                        <input type="hidden" class="@error('municipioParroquia') is-invalid @enderror">
                        @error('municipioParroquia')
                        <span class="error invalid-feedback text-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Nombre:</small>
                        <div class="input-group">
                            <input type="text" wire:model="nombreParroquia" class="form-control @error('nombreParroquia') is-invalid @enderror" placeholder="Nombre Completo">
                            @error('nombreParroquia')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Abreviatura:</small>
                        <div class="input-group">
                            <input type="text" wire:model="miniParroquia" class="form-control @error('miniParroquia') is-invalid @enderror" placeholder="Nombre corto">
                            @error('miniParroquia')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Asignación:</small>
                        <div class="input-group">
                            <input type="number" min="1" wire:model="familiasParroquia" class="form-control @error('familiasParroquia') is-invalid @enderror" placeholder="Nro. Familias">
                            @error('familiasParroquia')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer">

                    <div class="row col-12 justify-content-between" wire:loading.class="invisible" wire:target="formParroquias, editParroquias">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default_parroquias">Cerrar</button>
                        <button type="submit" class="btn  @if($parroquias_id) btn-primary @else btn-success @endif ">
                            Guardar @if($parroquias_id) Cambios @endif
                        </button>
                    </div>

                </div>

                {!! verSpinner("formParroquias, editParroquias, saveParroquias") !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

