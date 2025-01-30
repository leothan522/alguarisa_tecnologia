<ul class="todo-list list-group list-group-flush" >
    <li class="list-group-item">
        <span>Tipo: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verTipo }}</span>
    </li>
    <li class="list-group-item">
        <span>Marca: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verMarca }}</span>
    </li>
    <li class="list-group-item">
        <span>Modelo: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verModelo }}</span>
    </li>
    <li class="list-group-item">
        <span>Color: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verColor }}</span>
    </li>
    <li class="list-group-item">
        <span>Serial: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verSerial ?? "-" }}</span>
    </li>
    <li class="list-group-item">
        <span>Identificador: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verIdentificador ?? "-" }}</span>
    </li>
    <li class="list-group-item">
        <span>Condición: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verCondicion }}</span>
    </li>
    <li class="list-group-item">
        <span>Ubicación: </span>
        <span class="float-right text-bold text-lightblue text-uppercase">{{ $verUbicacion ?? "-" }}</span>
    </li>
    @if(!empty($verAdicional))
        <li class="list-group-item">
            <span>Información Adicional: </span><br>
            <span class="text-bold text-lightblue text-uppercase">{{ $verAdicional }}</span>
        </li>
    @endif
    @if($verificado)
        <li class="list-group-item">
            <span>Verificado por: </span>
            <span class="float-right text-bold text-danger text-uppercase">{{ $userVerify ?? "-" }}</span>
        </li>
    @endif
</ul>
