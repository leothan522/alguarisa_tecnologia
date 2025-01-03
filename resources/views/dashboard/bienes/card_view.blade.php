<div id="div_card_view" class="card card-navy card-outline">
    <div class="card-header" wire:loading.class="invisible" wire:target="create, cancel, show, showHide">
        <h3 class="card-title">
            {{ $title }}
        </h3>

        <div id="div_card_tools" class="card-tools">
            @if(!$form)
                <button type="button" class="btn btn-tool" wire:click="show('{{ $rowquid }}')">
                    <i class="fas fa-sync-alt"></i>
                </button>
            @endif
            @if($btnNuevo)
                <button type="button" class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('bienes.create')) disabled @endif >
                    <i class="fas fa-file"></i> Nuevo
                </button>
            @endif
            @if($btnCancelar)
                <button type="button" class="btn btn-tool" wire:click="cancel">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            @endif
            @if($btnEditar)
                <button type="button" class="btn btn-tool" wire:click="edit" @if(!comprobarPermisos('bienes.edit')) disabled @endif >
                    <i class="fas fa-edit"></i> Editar
                </button>
            @endif

            <button type="button" class="btn btn-tool d-md-none" wire:click="showHide">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div id="div_card_body" class="card-body table-responsive" wire:loading.class="invisible" wire:target="create, cancel, save, show, showHide" style="max-height: calc(100vh - {{ $size + $sizeFooter }}px)">

        <form class="row" wire:submit="save">

            <div class="col-sm-7 col-lg-6">

                <div class="card card-outline card-navy" >

                    <div class="card-header">
                        <h5 class="card-title">Información</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-book"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) p-0 @endif ">
                        @if($form)
                            @include('dashboard.empresas.form')
                        @else
                            @include('dashboard.bienes.show')
                        @endif
                    </div>

                </div>

            </div>

            <div class="col-sm-5 col-lg-6">

                <div class="card card-outline card-navy">

                    <div class="card-header">
                        <h5 class="card-title">Imagenes</h5>
                        <div class="card-tools">
                            <span class="btn-tool"><i class="fas fa-images"></i></span>
                        </div>
                    </div>

                    <div class="card-body @if(!$form) attachment-block p-0 m-0 @endif ">
                        @if($form)
                             @include('dashboard.empresas.form_imagen')
                        @else
                            @include('dashboard.bienes.show_imagen')
                        @endif
                    </div>
                </div>

            </div>

            @if($form)
                <div class="col-12">
                    <div class="col-md-4 float-right">
                        <button type="submit" class="btn btn-block @if($bienes_id) btn-primary @else btn-success @endif">
                            <i class="fas fa-save mr-1"></i>
                            Guardar
                            @if($bienes_id)
                                Cambios
                            @endif
                        </button>
                    </div>
                </div>
            @endif


        </form>

    </div>

    @if(!$form)
        <div id="div_card_footer" class="card-footer text-center" wire:loading.class="invisible" wire:target="create, cancel, show, showHide">

            <button type="button" class="btn btn-default btn-sm mr-1" wire:click="btnHorario"
                    @if(!comprobarPermisos('empresas.horario')) disabled @endif>
                <i class="fas fa-file-invoice"></i> Vinculados
            </button>

            <button type="button" class="btn btn-default btn-sm mr-1" wire:click="btnHorario"
                    @if(!comprobarPermisos('empresas.horario')) disabled @endif>
                <i class="fas fa-thumbtack"></i> Ubicación
            </button>

            <button type="button" class="btn btn-default btn-sm mr-1 mb-1 mb-sm-auto mt-1 mt-sm-auto" wire:click="btnHorario"
                    @if(!comprobarPermisos('empresas.horario')) disabled @endif>
                <i class="fas fa-images"></i> Cambiar Imagenes
            </button>

            <a href="{{ route('etiquetas.print', $rowquid ?? 0) }}" target="_blank" class="btn btn-default btn-sm mr-1">
                <i class="fas fa-print"></i> Imprimir Etiqueta
            </a>

            <button type="button" class="btn btn-default btn-sm" onclick="confirmToastBootstrap('deleteBienes', { rowquid: '{{ $rowquid }}'})"
                    @if(!comprobarPermisos('empresas.destroy')) disabled @endif>
                <i class="fas fa-trash-alt"></i> Borrar
            </button>

        </div>
    @endif

    {!! verSpinner('create, cancel, save, show, showHide') !!}

</div>
