<div class="col-12">

    <div class="card card-outline card-navy">

        <div class="card-header">
            <h5 class="card-title">Cambiar Imagenes</h5>
            <div class="card-tools">
                <span class="btn-tool"><i class="fas fa-images"></i></span>
            </div>
        </div>

        <div class="card-body">

            <form wire:submit="saveImagenes" xmlns:wire="http://www.w3.org/1999/xhtml">

                <div class="row justify-content-between p-2">

                    <div class="col-md-6 attachment-block p-3"
                         x-data="{ uploading: false, progress: 0 }"
                         x-on:livewire-upload-start="uploading = true"
                         x-on:livewire-upload-finish="uploading = false; progress = 0"
                         x-on:livewire-upload-cancel="uploading = false"
                         x-on:livewire-upload-error="uploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >

                        <div class="row">
                            <label class="col-12" for="name">
                                Frontal
                                <span class="badge float-right"><i class="fas fa-image"></i></span>
                            </label>
                        </div>

                        <div class="row justify-content-center mb-3 mt-3">
                            <div class="col-sm-10 col-md-8">
                                <img class="img-thumbnail" style="cursor: pointer;"
                                @if ($frontalPhoto)
                                    src="{{ $frontalPhoto->temporaryUrl() }}"
                                     @else
                                         src="{{ asset(verImagen($verImgFrontal)) }}"
                                     @endif
                                     {{--width="101" height="100"--}}  alt="Imagen Frontal del Bien" onclick="clickImgFrontal()" />
                                @if($verImgFrontal)
                                    <button type="button" class="btn badge text-danger position-absolute float-right"
                                            wire:click="btnBorrarImagen('frontal')" >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="input-group d-none">
                                    <div class="custom-file">
                                        <input type="file" wire:model="frontalPhoto" class="custom-file-input" id="customFileLangFrontal"
                                               lang="es" accept="image/jpeg, image/png">
                                        <label class="custom-file-label text-sm" for="customFileLangFrontal" data-browse="Elegir">
                                            <small>Seleccionar Imagen</small>
                                        </label>
                                    </div>
                                </div>
                                @error('frontalPhoto')
                                    <span class="text-sm text-bold text-danger text-center">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                         {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-10">
                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    {{--<progress max="100" x-bind:value="progress"></progress>--}}
                                    <div class="progress rounded">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                            <span x-text="`${progress}%`"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 attachment-block p-3"
                         x-data="{ uploading: false, progress: 0 }"
                         x-on:livewire-upload-start="uploading = true"
                         x-on:livewire-upload-finish="uploading = false; progress = 0"
                         x-on:livewire-upload-cancel="uploading = false"
                         x-on:livewire-upload-error="uploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >

                        <div class="row">
                            <label class="col-12" for="name">
                                Posterior / Serial
                                <span class="badge float-right"><i class="fas fa-image"></i></span>
                            </label>

                        </div>

                        <div class="row justify-content-center mb-3 mt-3">
                            <div class="col-sm-10 col-md-8">
                                <img class="img-thumbnail" style="cursor: pointer;"
                                @if ($posteriorPhoto)
                                    src="{{ $posteriorPhoto->temporaryUrl() }}"
                                     @else
                                         src="{{ asset(verImagen($verImgPosterior)) }}"
                                     @endif
                                     {{--width="101" height="100"--}}  alt="Imagen Posterior del Bien" onclick="clickImgPosterior()" />
                                @if($verImgPosterior)
                                    <button type="button" class="btn badge text-danger position-absolute float-right"
                                            wire:click="btnBorrarImagen('posterior')" >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="col-12 text-center">
                                <div class="input-group d-none">
                                    <div class="custom-file">
                                        <input type="file" wire:model="posteriorPhoto" class="custom-file-input" id="customFileLangPosterior"
                                               lang="es" accept="image/jpeg, image/png">
                                        <label class="custom-file-label text-sm" for="customFileLangPosterior" data-browse="Elegir">
                                            <small>Seleccionar Imagen</small>
                                        </label>
                                    </div>
                                </div>
                                @error('posteriorPhoto')
                                    <span class="text-sm text-bold text-danger text-center">
                                        <i class="icon fas fa-exclamation-triangle"></i>
                                         {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-10">
                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    {{--<progress max="100" x-bind:value="progress"></progress>--}}
                                    <div class="progress rounded">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" x-bind:style="`width: ${progress}%`" x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                            <span x-text="`${progress}%`"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-12">
                    <div class="col-md-4 float-right">
                        <button type="submit" class="btn btn-block btn-primary" @if(!$guardar) disabled @endif >
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </div>

            </form>

        </div>

        {!! verSpinner() !!}

    </div>

</div>
