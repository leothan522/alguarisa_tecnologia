<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">
    @php($i = 0)
    @foreach(allPermisos() as $modulo => $items)
        @php($i++)
        <div class="col-md-6 col-lg-4">
            <div class="card card-navy collapsed-card" wire:ignore.self>
                <div class="card-header">
                    <h3 class="card-title">
                        {{ $modulo }}
                        @foreach($items as $key => $value)
                            @if($key == "route")
                                <div class="custom-control custom-switch custom-switch-on-success float-left">
                                    <input type="checkbox" wire:click="setPermisos('{{ $value }}')"
                                           @if(leerJson($getPermisos, $value)) checked @endif
                                           class="custom-control-input" id="customSwitch_title_{{ $tabla }}_{{ $i }}">
                                    <label class="custom-control-label" for="customSwitch_title_{{ $tabla }}_{{ $i }}"></label>
                                </div>
                            @endif
                        @endforeach
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group text-sm">
                    @foreach($items as $key => $submenu)
                        @if($key == "submenu")
                            @php($x = 0)
                            @foreach($submenu as $key => $value)
                                @php($x++)
                                <li class="list-group-item">
                                    {{ $key }}
                                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                                        <input type="checkbox" wire:click="setPermisos('{{ $value }}')"
                                               @if(leerJson($getPermisos, $value)) checked @endif
                                               class="custom-control-input" id="customSwitch_{{ $tabla }}_{{ $x }}_{{ $i }}">
                                        <label class="custom-control-label" for="customSwitch_{{ $tabla }}_{{ $x }}_{{ $i }}"></label>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                    </ul>
                </div>

            </div>
        </div>
    @endforeach
</div>
