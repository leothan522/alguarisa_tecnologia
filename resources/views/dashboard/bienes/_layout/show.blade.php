<div class="row" xmlns:wire="http://www.w3.org/1999/xhtml">

    <div class="col-md-6">

        <div class="card card-outline card-navy">

            <div class="card-body box-profile">
                {{--<h1 class="profile-username text-center text-bold">
                    {{ mb_strtoupper($nombre) }}
                </h1>--}}
                <ul class="list-group list-group-unbordered {{--mt-3--}}">
                    <li class="list-group-item">
                        <b>Tipo</b> <a class="float-right text-uppercase">{{ $verTipo }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Marca</b> <a class="float-right text-uppercase">{{ $verMarca }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Modelo</b> <a class="float-right text-uppercase">{{ $verModelo }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Color</b> <a class="float-right text-uppercase">{{ $verColor }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Serial</b> <a class="float-right text-uppercase">{{ $serial }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Identificador</b> <a class="float-right text-uppercase">{{ $identificador }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Condición</b> <a class="float-right text-uppercase">{{ $verCondicion }}</a>
                    </li>
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
                                <img class="img-thumbnail" src="{{ verImagen($imagenFrontal, false, true) }}"
                                     {{--width="101" height="100"--}}  alt="Imagen Frontal"/>
                            </div>
                            <div class="col-5">
                                <img class="img-thumbnail" src="{{ verImagen($imagenPosterior, false, true) }}"
                                     {{--width="101" height="100"--}}  alt="Imagen Posterior"/>
                            </div>
                        </div>

                    </div>
                </div>

                @if(!empty($adicional))
                    <ul class="list-group list-group-unbordered mt-3">
                        <li class="list-group-item">
                            <b>Información Adicional</b> <br> <a class="text-uppercase">{{ $adicional }}</a>
                        </li>
                    </ul>
                @endif

            </div>
        </div>

    </div>

</div>
