@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        const breadcrumb_nuevo_oficio = document.querySelector('#breadcrumb_nuevo_oficio');
        const breadcrumb_volver = document.querySelector('#breadcrumb_volver');

        function headerButton(option) {

            if (option === 'nuevo'){
                breadcrumb_nuevo_oficio.classList.add('d-none');
                breadcrumb_volver.classList.remove('d-none');
                Livewire.dispatch('createHide');
            }

            if (option === 'show'){
                breadcrumb_nuevo_oficio.classList.add('d-none');
                breadcrumb_volver.classList.remove('d-none');
            }

            if (option === 'limpiar'){
                breadcrumb_nuevo_oficio.classList.remove('d-none');
                breadcrumb_volver.classList.add('d-none');
                Livewire.dispatch('limpiarHide');
            }

        }

        breadcrumb_nuevo_oficio.addEventListener('click', event => {
            event.preventDefault();
            headerButton('nuevo');
        });

        breadcrumb_volver.addEventListener('click', event => {
           event.preventDefault();
           addClassinvisible('#div_from_header');
           addClassinvisible('#div_from_body');
           addClassinvisible('#div_form_footer');
           verCargando('div_form_oficios');
           headerButton('limpiar');
        });

        Livewire.on('btnHeaderMovil', ({ option }) => {
            headerButton(option);
        });

        Livewire.on('deletePersonas', () => {
            addClassinvisible('#tbody_personas');
            verCargando('div_table_personas');
        });

        Livewire.on('deleteInstituciones', () => {
            addClassinvisible('#tbody_instituciones');
            verCargando('div_table_instituciones');
        });

        function select_2(id, data, event) {
            let html = '<select class="select2" multiple="multiple" data-placeholder="Seleccione" style="width: 100%;" id="'+ id +'"></select>';
            $("#div_" + id).html(html);
            $("#" + id)
                .select2({
                    data: data,
                    //theme: 'bootstrap4'
                })
                .val(null)
                .trigger('change')
                .on('change', function () {
                    let value = $(this).val();
                    Livewire.dispatch(event, { rowquid: value });
                });
        }

        Livewire.on('initSelectDirigido', ({ data }) => {
            select_2('select_dirigido_a', data, 'getSelectDirigido');
            $('#adicional').summernote('code', '');
        });

        Livewire.on('setSelectDirigido', ({ rowquid }) => {
            $('#select_dirigido_a').val(rowquid).trigger('change');
        });

        Livewire.on('initSelectCopia', ({ data }) => {
            select_2('select_con_copia_a', data, 'getSelectCopia');
        });

        Livewire.on('setSelectCopia', ({ rowquid }) => {
            $('#select_con_copia_a').val(rowquid).trigger('change');
        });

        Livewire.on('setTextArea', ({ texto }) => {
            $('#adicional').summernote('code', texto);
        });

        Livewire.on('setLabelIcono', () => {
            let nombre = document.getElementById('input_file_pdf').files[0].name;
            let size = document.getElementById('input_file_pdf').files[0].size;
            @this.set('nombrePDF', nombre);
            @this.set('sizePDF', size / 1024);
        });

        Livewire.on('irBienes', () => {
            var nuevaPestana = window.open("{{ route('bienes.index') }}", '_blank');
            nuevaPestana.focus();
        });

        Livewire.on('personasSelectInstituciones', ({ data }) => {

            let html = '<select id="personasSelectInstituciones"></select>';

            $("#div_select_personas_institucion").html(html);

            $("#personasSelectInstituciones")
                .select2({
                    theme: 'bootstrap4',
                    data: data,
                    placeholder: 'Seleccione',
                    allowClear: true
                })
                .val(null).trigger('change')
                .on('change', function () {
                    let val = $(this).val();
                    Livewire.dispatch('getPersonasSelectInstituciones', { rowquid: val });
                });
        });

        Livewire.on('setPersonasSelectInstituciones', ({ rowquid }) => {
            $('#personasSelectInstituciones').val(rowquid).trigger('change');
        });

        $('#adicional').val('{{ $adicional }}').summernote({
            lang: 'es-ES',
            placeholder: 'Información Adicional',
            toolbar: [
                // [groupName, [list of button]]
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ],
            callbacks: {
                onChange: function (contents, $editable) {
                    @this.set('adicional', contents);
                    //console.log('onChange:', contents, $editable);
                }
            }
        });

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });

        console.log('Hi!');
    </script>
@endsection
