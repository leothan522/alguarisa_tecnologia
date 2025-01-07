<div class="card-footer bg-white d-none">
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
