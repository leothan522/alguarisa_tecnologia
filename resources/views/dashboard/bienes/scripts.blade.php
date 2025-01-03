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

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('Hi!');
    </script>
@endsection
