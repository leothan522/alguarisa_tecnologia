<div wire:ignore.self class="modal fade" id="modal-sm-bien-oficios">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">


            <div class="modal-header bg-navy">
                <h4 class="modal-title">Oficios Vinculados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body p-0" id="div_modal_oficios_vinculados_body" wire:loading.class="invisible">

                <div class="table-responsive p-0" style="height: 40vh;">

                    <table class="table table-sm table-head-fixed table-hover text-nowrap">
                        <thead>
                        <tr class="text-lightblue">
                            <th class="text-uppercase">Nro. Oficio</th>
                            <th class="text-uppercase" style="width: 10%">Fecha</th>
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
                                            @if($equipo->pdf && !$web)
                                                <a href="{{ asset($equipo->pdf) }}" target="_blank" class="btn btn-sm text-primary m-0">
                                                    <i class="fas fa-paperclip"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-right text-uppercase">
                                            {{ getFecha($equipo->oficio->fecha) }}
                                        </td>
                                        <td class="text-right">
                                            @if(!$web)
                                                @if($equipo->pdf)
                                                    <a href="{{ asset($equipo->pdf) }}" target="_blank" class="btn btn-sm text-primary m-0">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-sm text-primary m-0"
                                                            wire:click="verOficio('{{ $equipo->idOficio }}')"
                                                            onclick="verOficio()">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @php($i++)
                                @endif
                            @endforeach
                            @if($i == 0)
                                <tr>
                                    <td colspan="3" class="text-center text-danger">
                                        Sin Oficio Vinculado.
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td colspan="3" class="text-center text-danger">
                                    Sin Oficio Vinculado.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>


                </div>


            </div>

            <div class="modal-footer card-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"
                        id="btn_modal_vinculados_cerrar">Cerrar
                </button>
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
