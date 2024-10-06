<div class="card card-navy <!--card-outline-->">
    <div class="card-header">
        <h3 class="card-title">
            Ver Oficio [ <b class="text-warning">{{ $numero }}</b> ]
        </h3>

        <div class="card-tools">
            {{--<a href="#" class="btn btn-tool" title="Anterior"><i class="fas fa-chevron-left"></i></a>
            <a href="#" class="btn btn-tool" title="Siguente"><i class="fas fa-chevron-right"></i></a>--}}
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
    <!-- /.card-header -->
    <div class="card-body p-0">
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
        <div class="card-footer bg-white">
            <div class="card card-navy card-outline">

                <div class="card-body table-responsive p-0" style="max-height: 30vh;" >

                    <table class="table table-head-fixed table-hover text-nowrap sticky-top">
                        <thead>
                        <tr class="text-navy">
                            {{--<th style="width: 10%">Código</th>--}}
                            <th>
                                Equipos
                                <small class="float-right">Cantidad {{ $equipos }}</small>
                            </th>
                        </tr>
                        </thead>
                    </table>

                    <!-- TO DO List -->
                    <ul class="todo-list" data-widget="todo-list">
                        @if(!empty($listarEquipos))
                            @php($i = 0)
                            @foreach($listarEquipos as $key => $equipo)
                                @php($i++)
                                <li>
                                    <small class="text text-uppercase">
                                        <small class="text-navy">{{ $i }}.&nbsp;-&nbsp;</small>
                                        {{ $equipo['tipo'] }}
                                        {{ $equipo['marca'] }}
                                        {{ $equipo['modelo'] }}
                                        @if(!is_null($equipo['serial']))
                                            , Serial: {{ $equipo['serial'] }}
                                        @endif
                                        @if(!is_null($equipo['identificador']))
                                            , Identificador: {{ $equipo['identificador'] }}
                                        @endif
                                    </small>
                                    <!-- General tools such as edit or delete-->
                                    {{--<div class="tools text-danger" wire:click="btnQuitarEquipo({{ $key }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>--}}
                                </li>
                            @endforeach
                        @else
                            <li class="text-center">
                                <span class="text">Sin Equipos vinculados</span>
                            </li>
                        @endif

                    </ul>

                </div>


            </div>
        </div>
        <div class="mailbox-read-message">
            @if($verPDF)
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{asset('ViewerJS/#../'.$verPDF)}}" allowfullscreen></iframe>
                </div>
            @endif
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer -->
    <div class="card-footer">
        <div class="float-right">
            <button type="button" class="btn btn-default btn-sm" wire:click="edit">
                <i class="fas fa-edit"></i> Editar
            </button>
        </div>
        <button type="button" class="btn btn-default btn-sm" wire:click="destroy">
            <i class="fas fa-trash-alt"></i> Eliminar
        </button>
        {{--<button type="button" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</button>--}}
    </div>
    <!-- /.card-footer -->

    {!! verSpinner() !!}

</div>
<!-- /.card -->
