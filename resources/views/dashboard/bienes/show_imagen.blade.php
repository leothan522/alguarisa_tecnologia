<div class="row justify-content-center">

    <div class="row col-12 justify-content-center mb-3 mt-3">
        <div class="col-7 mb-2">
            @if($miniFrontal)
                <a href="{{ verImagen($imagenFrontal, false, true) }}" data-toggle="lightbox" data-gallery="example-gallery" data-title="Imagen Frontal">
                    <img class="img-thumbnail" src="{{ verImagen($miniFrontal, false, true) }}" alt="Imagen Frontal"/>
                </a>
            @else
                <img class="img-thumbnail" src="{{ verImagen(null, false, true) }}" alt="Imagen Frontal"/>
            @endif
        </div>
        <div class="col-7">
            @if($miniPosterior)
                <a href="{{ verImagen($imagenPosterior, false, true) }}" data-toggle="lightbox" data-gallery="example-gallery" data-title="Imagen Posterior">
                    <img class="img-thumbnail" src="{{ verImagen($miniPosterior, false, true) }}" alt="Imagen Posterior"/>
                </a>
            @else
                <img class="img-thumbnail" src="{{ verImagen(null, false, true) }}" alt="Imagen Posterior"/>
            @endif
        </div>
    </div>

</div>
