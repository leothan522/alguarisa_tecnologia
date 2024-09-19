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

        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });


        $('#adicional').val('{{ $adicional }}').summernote({
            lang: 'es-ES',
            toolbar: [
                // [groupName, [list of button]]
                ['font', ['bold','italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    //console.log('onChange:', contents, $editable);
                    @this.set('adicional', contents)
                }
            }
        });

        $(document).ready(function () {
            $('#navbar_search_id').addClass('d-none');
        });


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

        console.log('Hi!');
    </script>
@endsection

