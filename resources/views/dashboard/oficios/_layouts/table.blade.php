<div class="card card-navy <!--card-outline-->">
    <div class="card-header">
        <h3 class="card-title">
            @if($keyword)
                Búsqueda { <b class="text-warning">{{ $keyword }}</b> } [ <b class="text-warning">{{ $rows }}</b> ]
                <button class="btn btn-tool text-warning" wire:click="cerrarBusqueda">
                    <i class="fas fa-times-circle"></i>
                </button>
            @else
                Registrados [ <b class="text-warning">{{ $rows }}</b> ]
            @endif
        </h3>

        <div class="card-tools">
            <form class="form-inline" wire:submit="buscar">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Buscar Oficio" wire:model="keyword" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="mailbox-controls">
            <!-- Check all button -->
            {{--<button type="button" class="btn btn-default btn-sm checkbox-toggle">
                <i class="far fa-square"></i>
            </button>--}}
            {{--<div class="btn-group">
                <button type="button" class="btn btn-default btn-sm">
                    <i class="far fa-trash-alt"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-reply"></i>
                </button>
                <button type="button" class="btn btn-default btn-sm">
                    <i class="fas fa-share"></i>
                </button>
            </div>--}}
            <!-- /.btn-group -->
            @if($order == 'DESC')
                <button type="button" class="btn btn-default btn-sm" wire:click="orderAscending">
                    <i class="fas fa-sort-amount-down"></i>
                </button>
            @else
                <button type="button" class="btn btn-default btn-sm" wire:click="orderDescending">
                    <i class="fas fa-sort-amount-up-alt"></i>
                </button>
            @endif
            <button type="button" class="btn btn-default btn-sm" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
                {{ $oficios->links('layouts.custom-pagination-links') }}
            </div>
            <!-- /.float-right -->
        </div>
        <div class="table-responsive mailbox-messages" style="height: 64vh;">
            <table class="table table-hover table-striped">
                <tbody>
                @if($oficios->isNotEmpty())
                    @foreach($oficios as $oficio)
                        <tr>
                            {{--<td>
                                <div class="icheck-primary">
                                    <input type="checkbox" value="" id="check1">
                                    <label for="check1"></label>
                                </div>
                            </td>--}}
                            {{--<td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>--}}
                            <td class="mailbox-name text-nowrap">
                                <a class="link-dark" wire:click="show('{{ $oficio->rowquid }}')" style="cursor: pointer;">
                                    {{ $oficio->numero }}
                                </a>
                            </td>
                            <td class="mailbox-subject text-nowrap text-truncate" style="width: 60%; max-width: 150px">

                                @if(!empty($oficio->dirigido))
                                    <b>{{ $this->getReceptor(json_decode($oficio->dirigido)) }}</b>
                                @else
                                    <b>[Dirigido a]</b> - [Con Copia a]
                                @endif

                                @if(!empty($oficio->copia))
                                    - {{ $this->getReceptor(json_decode($oficio->copia)) }}
                                @endif
                            </td>
                            <td>
                                <small
                                    class="float-right text-nowrap">Equipos: {{ formatoMillares($oficio->equipos, 0) }}</small>
                            </td>
                            <td class="mailbox-attachment">
                                @if($oficio->pdf)
                                    <i class="fas fa-paperclip"></i>
                                @endif
                            </td>
                            <td class="mailbox-date text-center">
                                {{ getFecha($oficio->fecha) }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    @if($keyword)
                        <tr>
                            <td colspan="4" class="mailbox-subject text-center">
                                Sin Resultados.
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4" class="mailbox-subject text-center">
                                Sin Registros Guardados.
                            </td>
                        </tr>
                    @endif
                @endif
                </tbody>
            </table>
            <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer p-0">
        <div class="mailbox-controls">
            <!-- Check all button -->
            {{--<button type="button" class="btn btn-default btn-sm checkbox-toggle">
                <i class="far fa-square"></i>
            </button>--}}
            @if($order == 'DESC')
                <button type="button" class="btn btn-default btn-sm" wire:click="orderAscending">
                    <i class="fas fa-sort-amount-down"></i>
                </button>
            @else
                <button type="button" class="btn btn-default btn-sm" wire:click="orderDescending">
                    <i class="fas fa-sort-amount-up-alt"></i>
                </button>
            @endif
            <button type="button" class="btn btn-default btn-sm" wire:click="actualizar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
                {{ $oficios->links('layouts.custom-pagination-links') }}
            </div>
            <!-- /.float-right -->
        </div>
    </div>

    {!! verSpinner() !!}

</div>
