<div wire:ignore.self class="modal fade" id="modal-sm-bien-ubicacion">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">


            <div class="modal-header bg-navy">
                <h4 class="modal-title">Ubicación</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card-body p-0"  id="div_modal_ubicacion_body" wire:loading.class="invisible">

                <div class="table-responsive p-0" style="height: 40vh;">

                    <table class="table table-sm table-head-fixed table-hover text-nowrap">
                        <thead>
                        <tr class="text-lightblue">
                            <th class="text-uppercase">Historico</th>
                            {{--<th style="width: 10%">Oficios</th>--}}
                            <th style="width: 5%">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($listarBienUbicacion->isNotEmpty())
                            @foreach($listarBienUbicacion as $ubicacion)
                                <tr>
                                    <td class="text-uppercase">
                                        {{ $ubicacion->ubicacion->nombre }}
                                        <small class="badge float-right">
                                            @if($ubicacion->actual)
                                                Actual
                                            @else
                                                <i class="fas fa-level-up-alt"></i>
                                            @endif
                                        </small>
                                    </td>
                                    {{--<td>
                                        {{ $ubicacion->moneda }}
                                    </td>--}}
                                    <td class="text-right">
                                        @if(!$web)
                                            @if($ubicacion->actual && comprobarPermisos('bienes.edit'))
                                                <button class="btn btn-sm text-danger m-0" wire:click="destroy('{{ $ubicacion->rowquid }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center text-danger">
                                    Sin Ubicación.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>


                </div>

                @if(!$web)
                    <form wire:submit="save" class=" @if(!comprobarPermisos('bienes.edit')) d-none @endif ">
                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select wire:model="ubicacionesRowquid" class="custom-select custom-select-sm @error("ubicaciones_id") is-invalid @enderror" id="ubicacion_select_ubicaciones">
                                                <option value="">Seleccione</option>
                                                @foreach($listarUbicaciones as $ubicacion)
                                                    <option value="{{ $ubicacion->rowquid }}">{{ mb_strtoupper($ubicacion->nombre) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 5%;">
                                    <button type="submit" class="btn btn-success btn-sm" @if(!comprobarPermisos('bienes.edit')) disabled @endif >
                                        <i class="fas fa-save"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                @endif


            </div>

            <div class="modal-footer card-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="btn_modal_bienes_propiedad_ubicacion">
                    Cerrar
                </button>
            </div>

            {!! verSpinner() !!}

        </div>
    </div>
</div>
