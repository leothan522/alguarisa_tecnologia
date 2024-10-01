<div class="row">
    <div class="col-md-4">
        @include('dashboard.oficios._layouts.cards')
    </div>
    <div class="col-md-8">

        <div class="@if($view != 'table') d-none @endif">
            @include('dashboard.oficios._layouts.table')
        </div>

        <div class="@if($view != 'show') d-none @endif">
            @include('dashboard.oficios._layouts.show')
        </div>

        <div class="@if($view != 'form') d-none @endif">
            @include('dashboard.oficios._layouts.form')
        </div>

    </div>
</div>


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
                    data: data
                })
                .val(null)
                .trigger('change')
                .on('change', function () {
                    let value = $(this).val();
                    Livewire.dispatch(event, { rowquid: value });
                });
        }

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

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        console.log('Hi!');
    </script>
@endsection

