@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

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

        console.log('Hi!');
    </script>
@endsection
