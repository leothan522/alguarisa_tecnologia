@extends('adminlte::page')

@section('plugins.Select2', true)

@section('title', 'Bienes')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-boxes"></i> Bienes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item active">Bienes Registrados</li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{--<p>Welcome to this beautiful admin panel.</p>--}}

    <div>
        @livewire('dashboard.bienes-component')
    </div>

    <div class="row">
        @livewire('dashboard.tipos-component')
        @livewire('dashboard.marcas-component')
        @livewire('dashboard.colores-component')
        @livewire('dashboard.modelos-component')
    </div>

@endsection

@section('right-sidebar')
    @include('dashboard.bienes.right-sidebar')
@endsection

@section('footer')
    @include('dashboard.footer')
@endsection

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        function verTipos() {
            Livewire.dispatch('limpiarTipos');
        }

        function verMarcas() {
            Livewire.dispatch('limpiarMarcas');
        }

        function verModelos() {
            Livewire.dispatch('limpiarModelos');
        }

        function verColores() {
            Livewire.dispatch('limpiarColores');
        }

        function select_2(id, data, event)
        {
            let html = '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +
                '<i class="fas fa-tag"></i>' +
                '</span>' +
                '</div> ' +
                '<select id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                dropdownParent: $('#modal-modelos'),
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
                /*allowClear: true*/
            });
            $('#'  + id).val(null).trigger('change');
            $('#'  + id).on('change', function() {
                var val = $(this).val();
                Livewire.dispatch(event, { id: val });
            });
        }

        Livewire.on('selectTipos', ({ data }) => {
            select_2('select_modelos_tipo', data, 'getSelectTipos');
        });

        Livewire.on('setSelectTipos', ({ id }) => {
            $('#select_modelos_tipo').val(id).trigger('change');
        });

        Livewire.on('selectMarcas', ({ data }) => {
            select_2('select_modelos_marca', data, 'getSelectMarcas');
        });

        Livewire.on('setSelectMarcas', ({ id }) => {
            $('#select_modelos_marca').val(id).trigger('change');
        });

        function buscar(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                alert('Falta vincular con el componente Livewire');
                //Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        console.log('Hi!');
    </script>
@endsection
