<form wire:submit="saveMunicipios">
    <div wire:ignore.self class="modal fade" id="modal-default-municipios">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header bg-navy">
                    <h4 class="modal-title" wire:loading.class="invisible" wire:target="limpiar, editMunicipios">
                        @if($municipios_id)
                            Editar
                        @else
                            Crear
                        @endif
                            Municipio
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" wire:loading.class="invisible">

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Nombre:</small>
                        <div class="input-group">
                            <input type="text" wire:model="nombreMunicipio" class="form-control @error('nombreMunicipio') is-invalid @enderror" placeholder="Nombre Completo">
                            @error('nombreMunicipio')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Abreviatura:</small>
                        <div class="input-group">
                            <input type="text" wire:model="miniMunicipio" class="form-control @error('miniMunicipio') is-invalid @enderror" placeholder="Nombre corto">
                            @error('miniMunicipio')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Asignación:</small>
                        <div class="input-group">
                            <input type="number" min="1" wire:model="familiasMunicipio" class="form-control @error('familiasMunicipio') is-invalid @enderror" placeholder="Nro. Familias">
                            @error('familiasMunicipio')
                            <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="modal-footer">

                    <div class="row col-12 justify-content-between" wire:loading.class="invisible" wire:target="limpiar, editMunicipios">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default_municipios">Cerrar</button>
                        <button type="submit" class="btn  @if($municipios_id) btn-primary @else btn-success @endif ">
                            Guardar @if($municipios_id) Cambios @endif
                        </button>
                    </div>

                </div>

                {!! verSpinner() !!}

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

