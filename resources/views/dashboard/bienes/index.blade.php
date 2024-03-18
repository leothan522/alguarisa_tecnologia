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
                    <li class="breadcrumb-item active">
                        <a {{--href="#"--}}>
                            <i class="fas fa-search"></i>
                            Busqueda Avanzada
                        </a>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-oficios">
                        <a href="#" id="btn_header_oficios">
                            <i class="fas fa-file-invoice"></i>
                            Oficios
                        </a>
                    </li>
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
        @livewire('dashboard.condiciones-component')
        @livewire('dashboard.ubicaciones-component')
        @livewire('dashboard.modal-oficios-component')
        @livewire('dashboard.modal-ubicaciones-component')
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

        function verCondiciones() {
            Livewire.dispatch('limpiarCondiciones');
        }

        function verUbicaciones() {
            Livewire.dispatch('limpiarUnicaciones');
        }

        function select_2_tablas(id, data, event, modal)
        {
            let html = '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +
                '<i class="fas fa-tag"></i>' +
                '</span>' +
                '</div> ' +
                '<select id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                dropdownParent: $('#modal-' + modal),
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

        Livewire.on('modeloSelectTipos', ({ data }) => {
            select_2_tablas('select_modelos_tipo', data, 'getModeloSelectTipos', 'modelos');
        });

        Livewire.on('setModeloSelectTipos', ({ id }) => {
            $('#select_modelos_tipo').val(id).trigger('change');
        });

        Livewire.on('modeloSelectMarcas', ({ data }) => {
            select_2_tablas('select_modelos_marca', data, 'getModeloSelectMarcas', 'modelos');
        });

        Livewire.on('setModeloSelectMarcas', ({ id }) => {
            $('#select_modelos_marca').val(id).trigger('change');
        });

        function select_2(id, data, event)
        {
            let html = '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +
                '<i class="far fa-bookmark"></i>' +
                '</span>' +
                '</div> ' +
                '<select id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
            });
            $('#'  + id).val(null).trigger('change');
            $('#'  + id).on('change', function() {
                var val = $(this).val();
                Livewire.dispatch(event, { id: val });
            });
        }

        Livewire.on('selectTipos', ({ data }) => {
            select_2('select_bienes_tipo', data, 'getselectTipos');
        });

        Livewire.on('setSelectTipos', ({ id }) => {
            $('#select_bienes_tipo').val(id).trigger('change');
        });

        Livewire.on('selectMarcas', ({ data }) => {
            select_2('select_bienes_marca', data, 'getselectMarcas');
        });

        Livewire.on('setSelectMarcas', ({ id }) => {
            $('#select_bienes_marca').val(id).trigger('change');
        });

        Livewire.on('selectColores', ({ data }) => {
            select_2('select_bienes_color', data, 'getselectColores');
        });

        Livewire.on('setSelectColores', ({ id }) => {
            $('#select_bienes_color').val(id).trigger('change');
        });

        Livewire.on('selectCondiciones', ({ data }) => {
            select_2('select_bienes_condicion', data, 'getselectCondiciones');
        });

        Livewire.on('setSelectCondiciones', ({ id }) => {
            $('#select_bienes_condicion').val(id).trigger('change');
        });

        Livewire.on('selectModelos', ({ data }) => {
            select_2('select_bienes_modelo', data, 'getselectModelos');
        });

        Livewire.on('setSelectModelos', ({ id }) => {
            $('#select_bienes_modelo').val(id).trigger('change');
        });

        function clickImgFrontal()
        {
            $('#customFileLangFrontal').click();
        }

        function clickImgPosterior()
        {
            $('#customFileLangPosterior').click();
        }

        function verSpinnerOculto() {
            $('.cargar_bienes').removeClass('d-none');
        }

        function buscar(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                verSpinnerOculto();
                input.blur();
                //alert('Falta vincular con el componente Livewire');
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        $('#btn_header_oficios').click(function (e) {
            e.preventDefault();
        });

        Livewire.on('clickNuevoBien', () =>{
            $('#btn_cerrar_model_oficios').click();
            $('#btn_create_bien').click();
        });

        console.log('Hi!');
    </script>
@endsection
