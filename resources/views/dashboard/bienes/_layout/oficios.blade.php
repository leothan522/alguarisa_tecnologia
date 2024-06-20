<div wire:ignore.self class="modal fade" id="modal-sm-bien-oficios" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">


            <div class="modal-header bg-navy">
                <h4 class="modal-title">Oficios Vinculados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body p-0">

                <div class="table-responsive p-0" style="height: 40vh;">

                    <table class="table table-sm table-head-fixed table-hover text-nowrap">
                        <thead>
                        <tr class="text-navy">
                            <th class="">Nro. Oficio</th>
                            <th style="width: 10%">Fecha</th>
                            <th style="width: 5%">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($listarEquipos->isNotEmpty())
                            @php($i = 0)
                            @foreach($listarEquipos as $equipo)
                                @if($equipo->ver)
                                <tr>
                                    <td class="text-uppercase">
                                        {{ $equipo->oficio->numero }}
                                    </td>
                                    <td class="text-right text-uppercase">
                                        {{ verFecha($equipo->oficio->fecha) }}
                                    </td>
                                    <td class="text-right">
                                        @if(!$web)
                                            <button class="btn btn-sm text-primary m-0" wire:click="verOficio({{ $equipo->oficios_id }})" onclick="verOficio()">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                    @php($i++)
                                @endif
                            @endforeach
                            @if($i == 0)
                                <tr>
                                    <td colspan="2" class="text-center text-danger">
                                        Sin Oficio Vinculado.
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td colspan="2" class="text-center text-danger">
                                    Sin Oficio Vinculado.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>


                </div>


            </div>

            <div class="modal-footer card-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btn_modal_vinculados_cerrar">Cerrar</button>
            </div>

            {!! verSpinner() !!}

            <div class="overlay-wrapper d-none cargar_bienes">
                <div class="overlay">
                    <div class="spinner-border text-navy" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
