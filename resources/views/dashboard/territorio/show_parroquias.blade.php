<div wire:ignore.self class="modal fade" id="modal-show-parroquias">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-navy">
                <h4 class="modal-title" wire:loading.class="invisible" wire:target.except="setEstatusParroquia">
                    Ver Parroquias
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" wire:loading.class="invisible">

                <div class="col-12 p-0">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span>Nombre:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">{{ $nombreParroquia }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Abreviatura:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">{{ empty($miniParroquia) ? "-" : $miniParroquia }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Municipio:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">
                                {{ $miniMunicipio }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span>Asignación:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">{{ formatoMillares($familiasParroquia, 0) }}</span>
                        </li>
                        <li class="list-group-item">
                            <span>Estatus:</span>
                            <span class="float-right text-bold text-lightblue text-uppercase">
                                @if($estatus)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </span>
                        </li>

                    </ul>

                </div>

            </div>

            <div class="modal-footer">

                <div class="row col-12 justify-content-between" wire:loading.class="invisible" wire:target.except="setEstatusParroquia">

                    <div class="btn-group">

                        <button type="button" class="btn btn-primary" onclick="confirmToastBootstrap('destroyParroquia',  { rowquid: '{{ $rowquid }}' })">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#modal-default-parroquias">
                            <i class="fas fa-edit"></i>
                        </button>

                        <button type="button" class="btn btn-primary" wire:click="setEstatusParroquia('{{ $rowquid }}')">
                            @if($estatus)
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-ban"></i>
                            @endif
                        </button>

                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_show_parroquias">
                        Cerrar
                    </button>

                </div>

            </div>

            {!! verSpinner() !!}

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

