<div wire:ignore.self class="modal fade" id="modal-default">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content {{--fondo--}}">
            <div class="modal-header bg-navy">
                <h4 class="modal-title">
                    @if($nuevo)
                        Registrar
                    @endif
                    @if($ver)
                        Ver
                    @endif
                    @if(!$editar && $cancelar && !$nuevo)
                        Editar
                    @endif
                    @if($imagenes)
                        Imagenes
                    @endif
                    Bienes
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body">


                <div @if(!$form) class="d-none" @endif >
                    @include('dashboard.bienes._layout.modal_form')
                </div>

                <div @if(!$ver) class="d-none" @endif >
                    @include('dashboard.bienes._layout.show')
                </div>

                <div @if(!$imagenes) class="d-none" @endif >
                    <div class="col-12">
                        <div class="card card-outline card-navy">

                            <div class="card-body box-profile">
                                <ul class="list-group {{--list-group-unbordered--}} {{--mt-3--}}">
                                    <li class="list-group-item list-group-item-dark">
                                        <span>Serial</span>
                                        <span class="float-right">
                                            @if($serial)
                                                [<span class="text-uppercase text-bold">{{ $serial }}</span>]
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="list-group-item list-group-item-dark">
                                        <span>Identificador</span>
                                        <span class="text-bold float-right text-uppercase">
                                            @if($identificador)
                                                [{{ $identificador }}]
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                </ul>

                            </div>

                        </div>
                    </div>
                    @livewire('dashboard.imagenes-component')
                </div>

                <div class="row m-5 @if(!$view) d-none @endif ">
                    <div class="col-12">
                        Debes seleccionar un Bien para empezar...
                    </div>
                </div>


            </div>
            <div class="modal-footer justify-content-between">

                <div class="text-center @if(!$footer || $cancelar) d-none @endif">

                    <button type="button" class="btn btn-default btn-sm" wire:click="btnOficios" onclick="verSpinnerOculto()"
                            data-toggle="modal" data-target="#modal-sm-bien-oficios"
                        {{--@if(!comprobarPermisos('bienes.edit')) disabled @endif--}}>
                        <i class="fas fa-file-invoice"></i> Vinculados
                    </button>

                    <button type="button" class="btn btn-default btn-sm" wire:click="btnUbicacion" onclick="verSpinnerOculto()"
                            data-toggle="modal" data-target="#modal-sm-bien-ubicacion"
                        {{--@if(!comprobarPermisos('bienes.edit')) disabled @endif--}}>
                        <i class="fas fa-thumbtack"></i> Ubicación
                    </button>
                    @if(comprobarPermisos('bienes.edit'))
                        <a href="{{ route('etiquetas.web', $rowquid ?? 0) }}" class="btn btn-default btn-sm" target="_blank" onclick="cerrarModal()">
                            <i class="fas fa-images"></i> Imagenes
                        </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" disabled>
                            <i class="fas fa-images"></i> Imagenes
                        </button>
                    @endif

                    <button type="button" class="btn btn-default btn-sm mt-1" wire:click="destroy"
                            @if(!comprobarPermisos('bienes.destroy')) disabled @endif>
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>

                </div>

                @if($cancelar && !$nuevo)
                    <button class="btn btn-default btn-sm" wire:click="btnCancelar">
                        <i class="fas fa-ban"></i> Cancelar
                    </button>
                @endif


                @if($editar)
                    <button class="btn btn-default btn-sm" wire:click="edit" @if(!comprobarPermisos('bienes.edit')) disabled @endif >
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button type="button" class="btn btn-default btn-sm" wire:click="btnCancelar" onclick="verSpinnerOculto()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                @endif

                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btn_modal_default">
                    Cerrar
                </button>

            </div>

            {!! verSpinner() !!}

        </div>
    </div>
</div>
