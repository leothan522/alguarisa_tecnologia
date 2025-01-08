@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-file-invoice"></i> Oficios</h1>
            </div>
            <div class="col-sm-6 d-md-none">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item">
                        <button id="breadcrumb_nuevo_oficio" type="button" class="btn btn-xs btn-link" @if(!comprobarPermisos('oficios.create')) disabled @endif><i class="fas fa-file"></i> Nuevo Oficio</button>
                        <button id="breadcrumb_volver" type="button" class="btn btn-xs btn-link d-none"><i class="fas fa-arrow-left"></i> Volver a Oficios</button>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
