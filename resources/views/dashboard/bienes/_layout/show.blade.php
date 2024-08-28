<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="col-md-6">

        <div class="card card-outline card-navy">

            <div class="card-body box-profile">
                {{--<h1 class="profile-username text-center text-bold">
                    {{ mb_strtoupper($nombre) }}
                </h1>--}}
                <ul class="list-group {{--list-group-unbordered--}} {{--mt-3--}}">
                    <li class="list-group-item list-group-item-dark">
                        <span>Tipo</span> <span class="text-bold float-right text-uppercase">{{ $verTipo }}</span>
                    </li>
                    <li class="list-group-item list-group-item-dark">
                        <span>Marca</span> <span class="text-bold float-right text-uppercase">{{ $verMarca }}</span>
                    </li>
                    <li class="list-group-item list-group-item-dark">
                        <span>Modelo</span> <span class="text-bold float-right text-uppercase">{{ $verModelo }}</span>
                    </li>
                    <li class="list-group-item list-group-item-dark">
                        <span>Color</span> <span class="text-bold float-right text-uppercase">{{ $verColor }}</span>
                    </li>
                    <li class="list-group-item list-group-item-dark">
                        <span>Serial</span> <span class="float-right">@if($serial)[<span class="text-uppercase text-bold">{{ $serial }}</span>] @else -  @endif</span>
                    </li>
                    <li class="list-group-item list-group-item-dark">
                        <span>Identificador</span> <span class="text-bold float-right text-uppercase">@if($identificador) [{{ $identificador }}] @else -  @endif</span>
                    </li>
                    <li class="list-group-item list-group-item-dark">
                        <span>Condición</span> <span class="text-bold float-right text-uppercase">{{ $verCondicion }}</span>
                    </li>
                    @if($verUbicacion)
                        <li class="list-group-item list-group-item-dark">
                            <span>Ubicación</span> <span class="text-bold float-right text-uppercase">{{ $verUbicacion }}</span>
                        </li>
                    @endif
                </ul>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card card-navy card-outline">
            <div class="card-body box-profile">

                <div class="row justify-content-center">
                    <div class="row col-12 attachment-block p-3">


                        <div class="col-12">
                            <label class="col-md-12" for="name">
                                Imagenes
                                <span class="badge float-right"><i class="fas fa-images"></i></span>
                            </label>

                        </div>

                        <div class="row col-12 justify-content-center mb-3 mt-3">
                            <div class="col-5">
                                @if($imagenFrontal)
                                    <a href="{{ verImagen($imagenFrontal, false, true) }}" data-toggle="lightbox" data-gallery="example-gallery" data-title="Imagen Frontal">
                                        <img class="img-thumbnail" src="{{ verImagen($miniFrontal, false, true) }}" {{--width="101" height="100"--}}  alt="Imagen Frontal"/>
                                    </a>
                                @else
                                    <img class="img-thumbnail" src="{{ verImagen($miniFrontal, false, true) }}" {{--width="101" height="100"--}}  alt="Imagen Frontal"/>
                                @endif
                            </div>
                            <div class="col-5">
                                @if($imagenPosterior)
                                    <a href="{{ verImagen($imagenPosterior, false, true) }}" data-toggle="lightbox" data-gallery="example-gallery" data-title="Imagen Posterior">
                                        <img class="img-thumbnail" src="{{ verImagen($miniPosterior, false, true) }}" {{--width="101" height="100"--}}  alt="Imagen Posterior"/>
                                    </a>
                                @else
                                    <img class="img-thumbnail" src="{{ verImagen($miniPosterior, false, true) }}" {{--width="101" height="100"--}}  alt="Imagen Posterior"/>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                @if(!empty($adicional))
                    <ul class="list-group {{--list-group-unbordered--}} mt-3">
                        <li class="list-group-item list-group-item-dark">
                            <span>Información Adicional</span> <br> <span class="text-bold text-uppercase">{{ $adicional }}</span>
                        </li>
                    </ul>
                @endif

            </div>
        </div>

    </div>

</div>
