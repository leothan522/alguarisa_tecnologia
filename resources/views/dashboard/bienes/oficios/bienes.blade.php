<div class="card card-navy" xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="card-header">
        <h3 class="card-title">
            Equipos
        </h3>

        <div class="card-tools">
            {{--@if(/*!$nuevo*/true)
                <button class="btn btn-tool" wire:click="create" @if(!comprobarPermisos('bienes.create')) disabled @endif >
                    <i class="fas fa-file"></i> Nuevo
                </button>
            @endif
            <button type="button" class="btn btn-tool" --}}{{--wire:click="setLimit" @if($rows > $listarBienes->count()) disabled @endif--}}{{-- >
                <i class="fas fa-sort-amount-down-alt"></i> Ver más
            </button>--}}
        </div>
    </div>

    <div class="card-body table-responsive p-0" {{--@if($tableStyle) style="height: 76vh;" @endif--}}>

        <table class="table table-head-fixed table-hover text-nowrap sticky-top">
            <thead>
            <tr class="text-navy">
                {{--<th style="width: 10%">Código</th>--}}
                <th>
                    Descripción
                    <small class="float-right">Cantidad {{ $equipos }}</small>
                </th>
            </tr>
            </thead>
        </table>

        <!-- TO DO List -->
        <ul class="todo-list" data-widget="todo-list">
            @if(/*$listarBienes->isNotEmpty()*/false)
                @foreach($listarBienes as $bien)
                    <li class=" @if($bien->id == $bienes_id) text-warning @endif " >
                    <!-- todo text -->
                    {{--<span class="text">
                            {{ $bien->codigo }}
                    </span>--}}
                    <!-- Emphasis label -->
                    <small class="text text-uppercase {{--badge-danger--}}">
                        {{ $bien->tipo->nombre }}
                        {{ $bien->marca->nombre }}
                        {{ $bien->modelo->nombre }}
                        @if(!is_null($bien->serial))
                            , Serial: {{ $bien->serial }}
                        @endif
                        @if(!is_null($bien->identificador))
                           , Identificador: {{ $bien->identificador }}
                        @endif

                    </small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools text-primary" wire:click="show({{ $bien->id }})">
                        <i class="fas fa-eye"></i>
                    </div>
                    </li>
                @endforeach
            @else
                <li class="text-center">
                    <!-- todo text -->
                    @if(/*$keyword*/false)
                        <span class="text">Sin resultados</span>
                    @else
                        <span class="text">Sin Equipos vinculados</span>
                    @endif
                </li>
            @endif

        </ul>
        <!-- /.TO DO List -->

    </div>



</div>
