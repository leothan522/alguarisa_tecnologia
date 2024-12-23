<ul class="todo-list list-group list-group-flush" >
    <li class="list-group-item">
        <span>Nombre: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $nombre }}</span>
    </li>
    <li class="list-group-item">
        <span>RIF: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $rif }}</span>
    </li>
    <li class="list-group-item">
        <span>Jefe: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $jefe }}</span>
    </li>
    <li class="list-group-item">
        <span>Moneda Base: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $moneda }}</span>
    </li>
    <li class="list-group-item">
        <span>Teléfonos: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $telefonos }}</span>
    </li>
    <li class="list-group-item">
        <span>Email: </span>
        <span class="float-right text-bold text-lightblue text-lowercase">{{ $email }}</span>
    </li>
    <li class="list-group-item">
        <span>Dirección: </span>
        <span class="float-right text-bold text-lightblue text-lowercase">{{ $email }}</span>
    </li>
    @if($empresas_id == $empresaDefault)
        <li class="list-group-item text-center">
            <small class="text-bold text-lightblue text-uppercase">
                <i class="fas fa-certificate"></i> Empresa Default
            </small>
        </li>
    @endif
</ul>
