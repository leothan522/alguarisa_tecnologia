<div class="row justify-content-center">

    <div class="col-md-4 col-lg-3 d-none d-md-block">
        @include('dashboard.oficios.cards')
    </div>

    <div class="col-md-8 col-lg-9">

        <div class="@if($ocultarTable) d-none @endif">
            @include('dashboard.oficios.table')
        </div>

        <div class="@if($ocultarShow) d-none @endif">
            @include('dashboard.oficios.show')
        </div>

        <div class="@if($ocultarForm) d-none @endif">
            @include('dashboard.oficios.form')
        </div>

    </div>

    <div class="col-sm-6 d-md-none">
        @include('dashboard.oficios.cards')
    </div>

</div>

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
    <style>

        .prueba_table {
            max-height: calc(100vh - {{ $size ?? 365 }}px);
        }

    </style>
@stop




