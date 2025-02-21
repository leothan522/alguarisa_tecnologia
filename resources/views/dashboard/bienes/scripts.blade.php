@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const btn_header_busqueda = document.querySelector('#btn_header_busqueda');
        const btn_movil_busqueda = document.querySelector('#btn_movil_busqueda');
        const btn_header_oficios = document.querySelector('#btn_header_oficios');

        btn_header_busqueda.addEventListener('click', event => {
            event.preventDefault();
            verModalBusqueda();
        });

        btn_movil_busqueda.addEventListener('click', event => {
            event.preventDefault();
            verModalBusqueda();
        });

        function verModalBusqueda() {
            addClassinvisible('#div_modal_busqueda_body');
            verCargando('modal-busqueda-avanzada');
            Livewire.dispatch('modalBusqueda');
        }

        function selectsBusquedaAvanzada(id, data, event) {
            let html = '<select class="custom-select" id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                dropdownParent: $('#modal-busqueda-avanzada'),
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
                allowClear: false
            })
                .val(null)
                .trigger('change')
                .on('change', function() {
                    let value = $(this).val();
                    Livewire.dispatch(event, { id: value });
                });
        }

        Livewire.on('busquedaSelectTipos', ({ data }) => {
            selectsBusquedaAvanzada('select_busqueda_tipo', data, 'getBusquedaSelectTipos');
        });

        Livewire.on('setBusquedaSelectTipos', ({ id }) => {
            $('#select_busqueda_tipo').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectMarcas', ({ data }) => {
            selectsBusquedaAvanzada('select_busqueda_marca', data, 'getBusquedaSelectMarcas');
        });

        Livewire.on('setBusquedaSelectMarcas', ({ id }) => {
            $('#select_busqueda_marca').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectColor', ({ data }) => {
            selectsBusquedaAvanzada('select_busqueda_color', data, 'getBusquedaSelectColor');
        });

        Livewire.on('setBusquedaSelectColor', ({ id }) => {
            $('#select_busqueda_color').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectCondicion', ({ data }) => {
            selectsBusquedaAvanzada('select_busqueda_condicion', data, 'getBusquedaSelectCondicion');
        });

        Livewire.on('setBusquedaSelectCondicion', ({ id }) => {
            $('#select_busqueda_condicion').val(id).trigger('change');
        });

        Livewire.on('busquedaSelectModelo', ({ data }) => {
            selectsBusquedaAvanzada('select_busqueda_modelo', data, 'getBusquedaSelectModelo');
        });

        Livewire.on('setBusquedaSelectModelo', ({ id }) => {
            $('#select_busqueda_modelo').val(id).trigger('change');
        });

        Livewire.on('cerrarBusqueda', () => {
            addClassinvisible("#table_bienes");
            verCargando('div_table_bienes');
            $('#cerrar_busqueda_avanzada').click();
        });

        function verOficiosVinculados() {
            addClassinvisible('#div_modal_oficios_vinculados_body');
            verCargando('modal-sm-bien-oficios');
        }

        function verOficio() {
            $('#btn_modal_vinculados_cerrar').click();
            $('#btn_header_oficios').click();
        }

        function verUbicacion() {
            addClassinvisible('#div_modal_ubicacion_body');
            verCargando('modal-sm-bien-ubicacion');
        }

        Livewire.on('cerrarModalPropiedades', ({ selector }) => {
            $('#' + selector).click();
        });

        function imgFrontal(){
            $('#customFileFrontal').click();
        }

        function imgPosterior(){
            $('#customFilePosterior').click();
        }

        function select_2(id, data, event) {
            let html = '<select class="custom-select" id="'+ id +'"></select>';
            $('#div_' + id).html(html);

            $('#'  + id).select2({
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
            })
                .val(null)
                .trigger('change')
                .on('change', function() {
                    let value = $(this).val();
                    Livewire.dispatch(event, { id: value });
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

        Livewire.on('deleteBienes', () => {
            addClassinvisible('#div_card_tools');
            addClassinvisible('#div_card_body');
            addClassinvisible('#div_card_footer');
            verCargando('div_card_view');
        });

        function buscar(){
            addClassinvisible("#table_bienes");
            verCargando('div_table_bienes');
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
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

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.sidebar_tablas_bienes').classList.remove('d-none');
        });

        Livewire.on('deleteTipos', () => {
            addClassinvisible('#tbody_tipos');
            verCargando('div_table_tipos');
        });

        Livewire.on('deleteMarcas', () => {
            addClassinvisible('#tbody_marcas');
            verCargando('div_table_marcas');
        });

        Livewire.on('deleteModelos', () => {
            addClassinvisible('#tbody_modelos');
            verCargando('div_table_modelos');
        });

        Livewire.on('deleteColores', () => {
            addClassinvisible('#tbody_colores');
            verCargando('div_table_colores');
        });

        Livewire.on('deleteCondiciones', () => {
            addClassinvisible('#tbody_condiciones');
            verCargando('div_table_condiciones');
        });

        Livewire.on('deleteUbicaciones', () => {
            addClassinvisible('#tbody_ubicaciones');
            verCargando('div_table_ubicaciones');
        });

        function selectsModelos(id, data, event) {
            let html = '<select class="custom-select" id="'+ id +'"></select>';
            $('#div_' + id).html(html);
            $('#'  + id).select2({
                dropdownParent: $('#modal-tabla-modelos'),
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
                allowClear: false
            });
            $('#'  + id)
                .val(null)
                .trigger('change')
                .on('change', function() {
                    let value = $(this).val();
                    Livewire.dispatch(event, { rowquid: value });
            });
        }

        Livewire.on('initModeloTipos', ({ data }) => {
            selectsModelos('select_modelos_tipo', data, 'getModeloTipos');
        });

        Livewire.on('setModeloTipos', ({ rowquid }) => {
            $('#select_modelos_tipo').val(rowquid).trigger('change');
        });

        Livewire.on('initModeloMarcas', ({ data }) => {
            selectsModelos('select_modelos_marca', data, 'getModeloMarcas');
        });

        Livewire.on('setModeloMarcas', ({ rowquid }) => {
            $('#select_modelos_marca').val(rowquid).trigger('change');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        Livewire.on('btnVerificar', () => {
            addClassinvisible('#div_card_tools');
            addClassinvisible('#div_card_body');
            addClassinvisible('#div_card_footer');
            verCargando('div_card_view');
        });

        function selectsUbicaciones(id, data, event) {
            let html = '<select class="custom-select" id="'+ id +'"></select>';
            $('#div_' + id).html(html);
            $('#'  + id).select2({
                dropdownParent: $('#modal-sm-bien-ubicacion'),
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
                allowClear: false
            });
            $('#'  + id)
                .val(null)
                .trigger('change')
                .on('change', function() {
                    let value = $(this).val();
                    Livewire.dispatch(event, { rowquid: value });
                });
        }

        Livewire.on('initSelectUbicaciones', ({ data }) => {
            selectsUbicaciones('select_ubicaciones_bien', data, 'getSelectUbicaciones');
        });

        console.log('Hi!');
    </script>
@endsection
