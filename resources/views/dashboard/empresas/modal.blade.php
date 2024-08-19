{{--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
    Launch Default Modal
</button>--}}

<div wire:ignore.self class="modal fade" id="modal-default" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content {{--fondo--}}">
            <div class="modal-header bg-navy">
                <h4 class="modal-title">
                    {{ $title }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btn_modal_default">Cerrar</button>--}}
                <div class="row">
                    @if(!$verDefault)
                        <button type="button" class="btn btn-default btn-sm mr-1"
                                wire:click="convertirDefault({{ $empresas_id }})"
                                @if(!comprobarPermisos('empresas.edit')) disabled @endif>
                            <i class="fas fa-certificate"></i> Default
                        </button>
                    @endif

                    <button type="button" class="btn btn-default btn-sm mr-1" wire:click="verHorario"
                            @if(!comprobarPermisos('empresas.horario')) disabled @endif>
                        <i class="fas fa-clock"></i> Horario
                    </button>

                    <button type="button" class="btn btn-default btn-sm" wire:click="edit"
                            @if(!comprobarPermisos('empresas.edit')) disabled @endif>
                        <i class="fas fa-edit"></i> Editar
                    </button>
                </div>

            </div>
            {!! verSpinner() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
