<div class="row justify-content-center">

    <div class="col-md-4 col-lg-3">
        <label>Parametros Manuales</label>
        <ul>
            <li class="text-wrap">
                numRowsPaginate
                [null|Int]
            </li>
            <li class="text-wrap">
                size_codigo
                [Int|null]
            </li>
            <li class="text-wrap">
                sin_serial
                [Int|String]
            </li>
            {{--<li>iva</li>
            <li>telefono_soporte</li>
            <li>codigo_pedido</li>--}}
        </ul>
    </div>

    <div class="col-md-8 col-lg-9">
        @include('dashboard.parametros.table')
        @include('dashboard.parametros.form')
    </div>

</div>
