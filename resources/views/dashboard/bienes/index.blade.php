@extends('adminlte::page')

@section('plugins.Lightbox', true)
@section('plugins.Select2', true)

@section('title', 'Bienes')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-boxes"></i> Bienes</h1>
            </div>
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-busqueda-avanzada">
                        <button class="btn bg-gradient-primary btn-sm" onclick="busquedaAvanzada()">
                            <i class="fas fa-search"></i>
                            Busqueda Avanzada
                        </button>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-oficios">
                        <button class="btn bg-gradient-primary btn-sm" id="btn_header_oficios">
                            <i class="fas fa-file-invoice"></i>
                            Oficios Entregados
                        </button>
                    </li>
                </ol>
            </div>
            <div class="col-sm-6 d-md-none">
                <ol class="breadcrumb float-sm-right">
                    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    <li class="breadcrumb-item active">Tablas</li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-tipos" onclick="verTipos()">
                        <span class="btn-link">Tipos</span>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-marcas" onclick="verMarcas()">
                        <span class="btn-link">Marcas</span>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-modelos" onclick="verModelos()">
                        <span class="btn-link">Modelos</span>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-colores" onclick="verColores()">
                        <span class="btn-link">Colores</span>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-condiciones" onclick="verCondiciones()">
                        <span class="btn-link">Condiciones</span>
                    </li>
                    <li class="breadcrumb-item" data-toggle="modal" data-target="#modal-ubicaciones" onclick="verUbicaciones()">
                        <span class="btn-link">Ubicaciones</span>
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
        @livewire('dashboard.modal-oficios-vinculados-component')
        @livewire('dashboard.modal-busqueda-component')
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

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

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
            Livewire.dispatch('limpiarUbicaciones');
        }

        function select_2_tablas(id, data, event, modal, btn = false)
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
                allowClear: btn
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
            select_2_tablas('select_bienes_tipo_modal', data, 'getselectTipos', 'default');
        });

        Livewire.on('setSelectTipos', ({ id }) => {
            $('#select_bienes_tipo').val(id).trigger('change');
            $('#select_bienes_tipo_modal').val(id).trigger('change');
        });

        Livewire.on('selectMarcas', ({ data }) => {
            select_2('select_bienes_marca', data, 'getselectMarcas');
            select_2_tablas('select_bienes_marca_modal', data, 'getselectMarcas', 'default')
        });

        Livewire.on('setSelectMarcas', ({ id }) => {
            $('#select_bienes_marca').val(id).trigger('change');
            $('#select_bienes_marca_modal').val(id).trigger('change');
        });

        Livewire.on('selectColores', ({ data }) => {
            select_2('select_bienes_color', data, 'getselectColores');
            select_2_tablas('select_bienes_color_modal', data, 'getselectColores', 'default');
        });

        Livewire.on('setSelectColores', ({ id }) => {
            $('#select_bienes_color').val(id).trigger('change');
            $('#select_bienes_color_modal').val(id).trigger('change');
        });

        Livewire.on('selectCondiciones', ({ data }) => {
            select_2('select_bienes_condicion', data, 'getselectCondiciones');
            select_2_tablas('select_bienes_condicion_modal', data, 'getselectCondiciones', 'default');
        });

        Livewire.on('setSelectCondiciones', ({ id }) => {
            $('#select_bienes_condicion').val(id).trigger('change');
            $('#select_bienes_condicion_modal').val(id).trigger('change');
        });

        Livewire.on('selectModelos', ({ data }) => {
            select_2('select_bienes_modelo', data, 'getselectModelos');
            select_2_tablas('select_bienes_modelo_modal', data, 'getselectModelos', 'default');
        });

        Livewire.on('setSelectModelos', ({ id }) => {
            $('#select_bienes_modelo').val(id).trigger('change');
            $('#select_bienes_modelo_modal').val(id).trigger('change');
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

        $('#btn_header_oficios').click(function (e) {
            e.preventDefault();
        });

        Livewire.on('clickNuevoBien', () =>{
            $('#btn_cerrar_model_oficios').click();
            $('#btn_create_bien').click();
        });

        function verOficio() {
            $('#btn_modal_vinculados_cerrar').click();
            $('#btn_header_oficios').click();
        }

        Livewire.on('cerrarBusqueda', () => {
            verSpinnerOculto();
            $('#cerrar_busqueda_avanzada').click();
        });

        function busquedaAvanzada() {
            Livewire.dispatch('modalBusqueda');
        }

        Livewire.on('busquedaSelectTipos', ({ data }) => {
            select_2_tablas('select_busqueda_tipo', data, 'getBusquedaSelectTipos', 'busqueda-avanzada', true);
        });

        Livewire.on('setBusquedaSelectTipos', ({ id }) => {
            $('#select_busqueda_tipo').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectMarcas', ({ data }) => {
            select_2_tablas('select_busqueda_marca', data, 'getBusquedaSelectMarcas', 'busqueda-avanzada', true);
        });

        Livewire.on('setBusquedaSelectMarcas', ({ id }) => {
            $('#select_busqueda_marca').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectColor', ({ data }) => {
            select_2_tablas('select_busqueda_color', data, 'getBusquedaSelectColor', 'busqueda-avanzada', true);
        });

        Livewire.on('setBusquedaSelectColor', ({ id }) => {
            $('#select_busqueda_color').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectCondicion', ({ data }) => {
            select_2_tablas('select_busqueda_condicion', data, 'getBusquedaSelectCondicion', 'busqueda-avanzada', true);
        });

        Livewire.on('setBusquedaSelectCondicion', ({ id }) => {
            $('#select_busqueda_condicion').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectModelo', ({ data }) => {
            select_2_tablas('select_busqueda_modelo', data, 'getBusquedaSelectModelo', 'busqueda-avanzada', true);
        });

        Livewire.on('setBusquedaSelectModelo', ({ id }) => {
            $('#select_busqueda_modelo').val(id).trigger('change');
        });

        Livewire.on('cerrarModalPropiedades', ({ selector }) => {
            $('#' + selector).click();
        });

        function cerrarModal() {
            $('#btn_modal_default').click();
        }

        function verBien(id) {
            verSpinnerOculto();
            $('#btn_cerrar_model_oficios').click();
            Livewire.dispatch('showBien', { id: id });
        }

        /* Ekko Lightbox */
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        });

        function buscar(){
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                verSpinnerOculto();
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        console.log('Hi!');
    </script>
@endsection
