@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const btnCerrarModalMunicipio = document.querySelector("#btn_modal_default_municipios");
        const btnCerrarShowMunicipio = document.querySelector("#btn_modal_show_municipios");
        const btnCerrarModalParroquia = document.querySelector("#btn_modal_default_parroquias");
        const btnCerrarShowParroquia = document.querySelector("#btn_modal_show_parroquias");

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
            btnCerrarShowParroquia.click();
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

        Livewire.on('cerrarModalParroquias', () => {
            btnCerrarModalParroquia.click();
            setTimeout(function () {
                verSpinnerParroquias();
            });
        });

        Livewire.on('initSelectMunicipios', ({ data }) => {

            let html = '<select id="form_parroquias_select"></select>';
            $('#form_parroquias_div_select').html(html);

            $('#form_parroquias_select').select2({
                dropdownParent: $('#modal-default-parroquias'),
                theme: 'bootstrap4',
                data: data,
                placeholder: 'Seleccione',
                dropdownCssClass: 'text-uppercase'
                //allowClear: true
            })
                .val(null)
                .trigger('change')
                .on('change', function () {
                    let rowquid = $(this).val();
                    Livewire.dispatch('getSelectMunicipios', { rowquid: rowquid });
                });

        });

        Livewire.on('setSelectMunicipio', ({ rowquid }) => {
            $("#form_parroquias_select").val(rowquid).trigger('change');
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('Hi!');
    </script>
@endsection
