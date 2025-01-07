@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        // $('.select2').select2();

        //Initialize Select2 Elements
        /*$('.select2bs4').select2({
            theme: 'bootstrap4'
        });*/

        //Enable check and uncheck all functionality
        // $('.checkbox-toggle').click(function () {
        //     var clicks = $(this).data('clicks')
        //     if (clicks) {
        //         //Uncheck all checkboxes
        //         $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        //         $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        //     } else {
        //         //Check all checkboxes
        //         $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        //         $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        //     }
        //     $(this).data('clicks', !clicks)
        // });

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

            let html = '<div class="input-group-prepend">' +
                '<span class="input-group-text">' +
                '<i class="fas fa-tag"></i>' +
                '</span>' +
                '</div> ' +
                '<select id="personasSelectInstituciones"></select>';

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

        document.querySelector("#btn_header_nuevo_oficio").addEventListener('click', event => {
            event.preventDefault();
            $('#btn_cards_nuevo').click();
        });

        console.log('Hi!');
    </script>
@endsection
