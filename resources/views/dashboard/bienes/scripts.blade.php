@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

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
