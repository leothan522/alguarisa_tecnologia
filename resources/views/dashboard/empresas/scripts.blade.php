@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        function buscar(){
            addClassinvisible("#table_empresas");
            verCargando('div_table_empresas');
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        function imgEmpresa()
        {
            $('#customFileLang').click();
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

        Livewire.on('delete', () => {
            addClassinvisible('#div_card_body');
            addClassinvisible('#div_card_footer');
            verCargando('div_card_view');
        });

        console.log('Hi!');
    </script>
@endsection
