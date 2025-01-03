<form class="row" wire:submit="save">

    <div class="col-md-6" wire:loading.class="invisible" wire:target="save">

        <div class="card card-outline card-navy">

            <div class="card-header">
                <h5 class="card-title">Imagen Frontal</h5>
                <div class="card-tools">
                    <span class="btn-tool"><i class="fas fa-image"></i></span>
                </div>
            </div>

            <div class="card-body attachment-block p-0 m-0">

                {!! verSpinner('btnBorrarImagenFrontal') !!}

                <div class="row justify-content-center"
                     x-data="{ uploading: false, progress: 0 }"
                     x-on:livewire-upload-start="uploading = true"
                     x-on:livewire-upload-finish="uploading = false; progress = 0"
                     x-on:livewire-upload-cancel="uploading = false"
                     x-on:livewire-upload-error="uploading = false"
                     x-on:livewire-upload-progress="progress = $event.detail.progress" wire:loading.class="invisible" wire:target="btnBorrarImagenFrontal">

                    <div class="d-none">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" wire:model.live="photoFrontal" class="custom-file-input" id="customFileFrontal" lang="es" accept="image/jpeg, image/png">
                                <label class="custom-file-label text-sm" for="customFileFrontal" data-browse="Elegir">Seleccionar Imagen</label>
                            </div>
                        </div>
                    </div>

                    <div class="row col-12 justify-content-center mb-3 mt-3">
                        <div class="col-8" style="cursor:pointer;">
                            <img class="img-thumbnail" src="{{ asset(verImagen($verFrontal)) }}" alt="Logo Empesa" onclick="imgFrontal()"   />
                            @if($photoFrontal || $btnImgBorrarFrontal)
                                <button type="button" class="btn badge text-danger position-absolute float-right" wire:click="btnBorrarImagenFrontal">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 text-center mb-3">
                        @error('photoFrontal')
                        <span class="text-sm text-bold text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-10">
                        <!-- Progress Bar -->
                        <div x-show="uploading">
                            {{--<progress max="100" x-bind:value="progress"></progress>--}}
                            <div class="progress rounded mb-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                    <span x-text="`${progress}%`"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6" wire:loading.class="invisible" wire:target="save">

        <div class="card card-outline card-navy">

            <div class="card-header">
                <h5 class="card-title">Imagen Posterior / Serial</h5>
                <div class="card-tools">
                    <span class="btn-tool"><i class="fas fa-image"></i></span>
                </div>
            </div>

            <div class="card-body attachment-block p-0 m-0">


                {!! verSpinner('btnBorrarImagenPosterior') !!}

                <div class="row justify-content-center"
                     x-data="{ uploading: false, progress: 0 }"
                     x-on:livewire-upload-start="uploading = true"
                     x-on:livewire-upload-finish="uploading = false; progress = 0"
                     x-on:livewire-upload-cancel="uploading = false"
                     x-on:livewire-upload-error="uploading = false"
                     x-on:livewire-upload-progress="progress = $event.detail.progress" wire:loading.class="invisible" wire:target="btnBorrarImagenPosterior">

                    <div class="d-none">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" wire:model.live="photoPosterior" class="custom-file-input" id="customFilePosterior" lang="es" accept="image/jpeg, image/png">
                                <label class="custom-file-label text-sm" for="customFilePosterior" data-browse="Elegir">Seleccionar Imagen</label>
                            </div>
                        </div>
                    </div>

                    <div class="row col-12 justify-content-center mb-3 mt-3">
                        <div class="col-8" style="cursor:pointer;">
                            <img class="img-thumbnail" src="{{ asset(verImagen($verPosterior)) }}" alt="Foto Posterior" onclick="imgPosterior()"   />
                            @if($photoPosterior || $btnImgBorrarPosterior)
                                <button type="button" class="btn badge text-danger position-absolute float-right" wire:click="btnBorrarImagenPosterior">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 text-center mb-3">
                        @error('photoPosterior')
                        <span class="text-sm text-bold text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="col-10">
                        <!-- Progress Bar -->
                        <div x-show="uploading">
                            {{--<progress max="100" x-bind:value="progress"></progress>--}}
                            <div class="progress rounded mb-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                    <span x-text="`${progress}%`"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>

    <div class="col-12" wire:loading.class="invisible" wire:target="save">
        <div class="col-md-4 d-none" wire:loading.class="d-inline-block">
            <div class="spinner-border text-primary spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Cargando...
        </div>
        <div class="col-md-4 float-right">
            <button type="submit" class="btn btn-block btn-primary" @if(!$bienes_id || !$saveImagen) disabled @endif wire:loading.attr="disabled">
                <i class="fas fa-save mr-1"></i>
                Guardar
            </button>
        </div>
    </div>

    {!! verSpinner('save') !!}

</form>
