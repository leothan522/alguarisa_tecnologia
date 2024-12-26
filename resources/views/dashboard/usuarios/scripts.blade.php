@section('js')
    <script src="{{ asset("js/app.js") }}"></script>
    <script>

        function buscar(){
            addClassinvisible('#tbody_usuarios');
            verCargando('div_table_usuarios');
            let input = $("#navbarSearch");
            let keyword  = input.val();
            if (keyword.length > 0){
                input.blur();
                Livewire.dispatch('buscar', { keyword: keyword });
            }
            return false;
        }

        Livewire.on('delete', () => {
            addClassinvisible('#tbody_usuarios');
            verCargando('div_table_usuarios');
        });

        Livewire.on('deleteHide', () => {
            addClassinvisible('#div_show_header');
            addClassinvisible('#div_show_body');
            verCargando('div_show_user');
        });

        console.log('Hi!');
    </script>
@endsection
