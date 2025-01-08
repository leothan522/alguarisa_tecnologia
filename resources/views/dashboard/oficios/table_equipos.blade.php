<!-- TO DO List -->
<ul class="todo-list" data-widget="todo-list">
    @if(!empty($listarEquipos))
        @php($i = 0)
        @foreach($listarEquipos as $key => $equipo)
            @php($i++)

            <li>
                <!-- Emphasis label -->
                <small class="text text-uppercase">
                <span>
                    <span class="text-lightblue">{{ $i }}.&nbsp;-&nbsp;</span>
                    {{ $equipo['tipo'] }}
                    {{ $equipo['marca'] }}
                    {{ $equipo['modelo'] }}
                    @if(!is_null($equipo['serial']))
                        , Serial: <span class="text-nowrap">{{ $equipo['serial'] }}</span>
                    @endif
                    @if(!is_null($equipo['identificador']))
                        , Identificador: <span class="text-nowrap">{{ $equipo['identificador'] }}</span>
                    @endif
                </span>
                </small>

                <!-- General tools such as edit or delete-->
                @if(!$ocultarForm)
                    <div class="tools text-danger" wire:click="btnQuitarEquipo({{ $key }})">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                @else
                    <div class="tools text-lightblue">
                        <i class="fas fa-eye"></i>
                    </div>
                @endif


            </li>

        @endforeach
    @else
        <li class="text-center">
            <span class="text">Sin Equipos vinculados</span>
        </li>
    @endif
</ul>
<!-- /.TO DO List -->

