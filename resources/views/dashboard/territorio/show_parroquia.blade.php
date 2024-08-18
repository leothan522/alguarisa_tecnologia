<div wire:ignore.self class="modal fade" id="modal-default" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content {{--fondo--}}">
            <div class="modal-header">
                <h4 class="modal-title">
                    Default Modal
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" {{--class="text-white"--}}>×</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="col-12">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                    <span class="nav-link">
                        Cedula <span class="float-right text-bold text-uppercase">{{ is_numeric($cedula) ? formatoMillares($cedula,0) : $cedula }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Nombre <span class="float-right text-bold text-uppercase">{{ $nombre }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Apellido <span class="float-right text-bold text-uppercase">{{ $apellido }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Teléfono <span class="float-right text-bold">{{ $telefono }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Email <span class="float-right text-bold text-lowercase">{{ $email }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Dirección <span class="float-right text-bold text-lowercase">{{ $direccion }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Instalación <span class="float-right text-bold">{{ verFecha($instalacion) }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Fecha Pago <span class="float-right text-bold">{{ verFecha($pago) }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Latitud <span class="float-right text-bold">{{ $latitud }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        Longitud <span class="float-right text-bold">{{ $longitud }}</span>
                    </span>
                                </li>
                                <li class="nav-item">
                    <span class="nav-link">
                        GPS <span class="float-right text-bold">{{ $gps }}</span>
                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_modal_default">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            {!! verSpinner() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
