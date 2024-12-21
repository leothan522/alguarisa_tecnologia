<div class="attachment-block col-8">
    @if(false)
        <a href="{{ verImagen($verImagen, false, true) }}" data-toggle="lightbox" data-title="Ver Imagen">
            <img class="img-thumbnail" src="{{ verImagen($verMini, false, true) }}"
                 {{--width="101" height="100"--}}  alt="Logo Empresa"/>
        </a>
    @else
        <img class="img-thumbnail" src="{{ verImagen(null, false, true) }}"
             {{--width="101" height="100"--}}  alt="Logo Empresa"/>
    @endif
</div>
