@section('js')
    <script src="{{ asset('vendor/ekko-lightbox/ekko-lightbox.js') }}"></script>
    <script>

        Livewire.on('actualizarMovil', () => {
            window.location.reload();
        });

        function verSpinnerOculto() {
            $('.cargar_bienes').removeClass('d-none');
        }

        function btnOficios(id) {
            verSpinnerOculto();
            Livewire.dispatch('getBienesOficios', {bienID: id});
        }

        function btnUbicacion(id) {
            Livewire.dispatch('getBienesUbicaciones', {bienID: id});
        }

        function btnCambiarImagenes(id) {
            $('.card_mostrar_datos').addClass('d-none');
            $('.card_cambiar_imagenes').removeClass('d-none');
            Livewire.dispatch('initImagenes', {id: id});
        }

        function btnCancelar() {
            $('.card_mostrar_datos').removeClass('d-none');
            $('.card_cambiar_imagenes').addClass('d-none');
        }

        function imgFrontal(){
            $('#customFileFrontal').click();
        }

        function imgPosterior(){
            $('#customFilePosterior').click();
        }

        Livewire.on('cerrarModalLogin', ({nombre}) => {
            location.reload();
            //$('#btn_modal_login_cerrar').click();
        });

        function cerrarSesion() {
            $('#btn_cerrar_sesion').click();
        }

        /* Ekko Lightbox */
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        });

    </script>
@endsection
