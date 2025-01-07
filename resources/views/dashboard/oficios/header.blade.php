@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-file-invoice"></i> Oficios</h1>
            </div>
            <div class="col-sm-6 d-md-none mt-2 mt-sm-auto">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item text-primary" style="cursor: pointer;">
                        <span class="d-none" id="breadcrumb_nuevo_oficio"><i class="fas fa-file"></i> Nuevo Oficio</span>
                        <span id="breadcrumb_volver"><i class="fas fa-arrow-left"></i> Volver a Oficios</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
