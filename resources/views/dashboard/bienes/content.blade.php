<div class="row justify-content-center">
    <div class="col-md-5 col-lg-4 @if($ocultarTable) d-none @endif ">
        @include('dashboard.bienes.table')
        <div class="d-md-none mb-2 text-center">
            <a href="#" data-toggle="modal" data-target="#modal-busqueda-avanzada" id="btn_movil_busqueda">
                <i class="fas fa-search"></i> Busqueda Avanzada
            </a>
        </div>
        <div class="d-md-none mb-2 text-center">
            <a href="{{ route('bienes.export') }}" {{--target="_blank"--}} onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})" >
                <i class="far fa-file-excel"></i> Exportar Excel
            </a>
        </div>
    </div>
    <div class="col-md-7 col-lg-8 @if($ocultarCard) d-none @endif d-md-block">
        @include('dashboard.bienes.card_view')
    </div>
</div>
