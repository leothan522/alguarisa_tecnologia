@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-globe-americas"></i> Territorio</h1>
            </div>
            <div class="col-sm-6 d-md-none mt-2 mt-sm-auto">
                <ol class="breadcrumb float-sm-right">
                    <li id="breadcrumb_municipios" class="breadcrumb-item active">
                        <span>Municipios</span>
                    </li>
                    <li id="breadcrumb_parroquias" class="breadcrumb-item text-primary" onclick="verDivParroquias()" style="cursor: pointer;">
                        <span>Parroquias</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
