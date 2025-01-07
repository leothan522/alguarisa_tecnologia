<div class="card card-navy card-outline">

    <div class="card-header">

        <h3 class="card-title">
            Ver Oficio [ <b class="text-warning text-uppercase">{{ $numero }}</b> ]
        </h3>

        <div class="card-tools">
            @if($verBtnRepetido)
                <button type="button" class="btn btn-tool" wire:click="verNumerosRepeditos">
                    <i class="far fa-copy"></i> Numero Repetido
                </button>
            @endif
            <button type="button" class="btn btn-tool" wire:click="show('{{ $rowquid }}')">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>

    </div>

    <div class="card-body p-0" style="min-height: calc(100vh - {{ $size }}px); max-height: calc(100vh - {{ $size }}px)">

        <div class="mailbox-read-info mr-3 ml-3">
            <h5>
                @if(!empty($dirigido))
                    {!! $this->getReceptor($dirigido, true) !!}
                @else
                    [Dirigido a]
                @endif
            </h5>
            <h6 class="mt-2">
                @if(!empty($copia))
                    {!! $this->getReceptor($copia, true, true) !!}
                @else
                    <br>
                @endif
                <span class="mailbox-read-time float-right text-capitalize">
                    {{--15 Feb. 2015--}}
                    {{ fechaEnLetras($fecha, "D MMMM YYYY") }}
                    {{--11:03 PM--}}
                </span>
            </h6>
        </div>

        <!-- /.mailbox-read-info -->
        {{--<div class="mailbox-controls with-border text-center">
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Borrar">
                <i class="far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Editar">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" title="Imprimir">
                <i class="fas fa-print"></i>
            </button>
        </div>--}}
        <!-- /.mailbox-controls -->

        @if(!empty($adicional))
            <div class="card-footer bg-white">
                <div class="card card-navy card-outline">
                    <div class="card-body table-responsive p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Información Adicional</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {!! $adicional !!}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        @include('dashboard.oficios.table_equipos')

        <div class="mailbox-read-message">
            @if($verPDF)
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{asset('ViewerJS/#../'.$verPDF)}}" allowfullscreen></iframe>
                </div>
            @endif
        </div>

    </div>

    <div class="card-footer">
        <div class="float-right">
            <button type="button" class="btn btn-default btn-sm" wire:click="edit" @if(!comprobarPermisos('oficios.edit')) disabled @endif >
                <i class="fas fa-edit"></i> Editar
            </button>
        </div>
        <button type="button" class="btn btn-default btn-sm" wire:click="destroy" @if(!comprobarPermisos('oficios.destroy')) disabled @endif >
            <i class="fas fa-trash-alt"></i> Eliminar
        </button>
        {{--<button type="button" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</button>--}}
    </div>

    {!! verSpinner() !!}

</div>

