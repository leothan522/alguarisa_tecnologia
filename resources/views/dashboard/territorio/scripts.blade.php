@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const btnCerrarModalMunicipio = document.querySelector("#btn_modal_default_municipios");
        const btnCerrarShowMunicipio = document.querySelector("#btn_modal_show_municipios");

        function verSpinnerMunicipios() {
            addClassinvisible("#tbody_municipios")
            verCargando('div_table_municipios');
        }

        function verSpinnerParroquias() {
            addClassinvisible("#tbody_parroquias");
            verCargando('div_table_parroquias');
        }

        Livewire.on('destroyMunicipio', () => {
            verSpinnerMunicipios();
            btnCerrarShowMunicipio.click();
        });

        Livewire.on('destroyParroquia', () => {
            verSpinnerParroquias();
        });

        Livewire.on('buscar', () => {
            verSpinnerMunicipios();
            verSpinnerParroquias();
        });

        Livewire.on('cerrarModalMunicipios', () => {
            btnCerrarModalMunicipio.click();
            setTimeout(function () {
                verSpinnerMunicipios();
            });
        });

        console.log('Hi!');
    </script>
@endsection
