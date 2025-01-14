@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-boxes"></i> Bienes</h1>
            </div>
            <div class="col-sm-6 d-none d-md-inline">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#" data-toggle="modal" data-target="#modal-busqueda-avanzada" id="btn_header_busqueda">
                            <i class="fas fa-search"></i> Busqueda Avanzada
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('bienes.export') }}" {{--target="_blank"--}} onclick="toastBootstrap({ toast: 'toast', type: 'info', message: 'Descargando Archivo.'})" >
                            <i class="far fa-file-excel"></i> Exportar Excel
                        </a>
                    </li>
                    <li class="breadcrumb-item d-none">
                        <a href="#" data-toggle="modal" data-target="#modal-oficios" id="btn_header_oficios">
                            <i class="fas fa-file-invoice"></i> Oficios Entregados
                        </a>
                    </li>
                    {{--<li class="breadcrumb-item active">Pagina en Blanco</li>--}}
                </ol>
            </div>
        </div>
    </div>
@endsection
