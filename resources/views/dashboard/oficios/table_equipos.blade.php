<!-- TO DO List -->
<ul class="todo-list" data-widget="todo-list">
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
            <div class="tools text-lightblue">
                <i class="fas fa-eye"></i>
            </div>

        </li>

    @endforeach
</ul>
<!-- /.TO DO List -->

