<div class="card card-navy <!--card-outline-->">
    <div class="card-header">
        <h3 class="card-title">Oficios Entregados</h3>

        <div class="card-tools">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Buscar Oficio">
                <div class="input-group-append">
                    <div class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </div>
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
            <button type="button" class="btn btn-default btn-sm" wire:click="limpiar">
                <i class="fas fa-sort-amount-down"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" wire:click="limpiar">
                <i class="fas fa-sort-amount-up-alt"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" wire:click="limpiar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
                {{ $oficios->links('layouts.custom-pagination-links') }}
            </div>
            <!-- /.float-right -->
        </div>
        <div class="table-responsive mailbox-messages" style="height: 67vh;">
            <table class="table table-hover table-striped">
                <tbody>
                @foreach($oficios as $oficio)
                    <tr>
                        {{--<td>
                            <div class="icheck-primary">
                                <input type="checkbox" value="" id="check1">
                                <label for="check1"></label>
                            </div>
                        </td>--}}
                        {{--<td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td>--}}
                        <td class="mailbox-name">
                            <button class="btn btn-link" href="read-mail.html">
                                {{ $oficio->numero }}
                            </button>
                        </td>
                        <td class="mailbox-subject" style="width: 60%">
                            {{--<b>Yilda Ledezma</b> - Anakary Castro--}}

                        </td>
                        <td class="mailbox-attachment">

                        </td>
                        <td class="mailbox-date">
                            {{ getFecha($oficio->fecha) }}
                        </td>
                    </tr>
                @endforeach
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
            <button type="button" class="btn btn-default btn-sm" wire:click="limpiar">
                <i class="fas fa-sync-alt"></i>
            </button>
            <div class="float-right">
                {{ $oficios->links('layouts.custom-pagination-links') }}
            </div>
            <!-- /.float-right -->
        </div>
    </div>
</div>
