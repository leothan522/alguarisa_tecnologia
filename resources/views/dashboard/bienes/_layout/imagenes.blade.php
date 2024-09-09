<div class="col-12">

    <div class="card card-outline card-navy">

        <div class="card-header">
            <h5 class="card-title">Cambiar Imagenes</h5>
            <div class="card-tools">
                <span class="btn-tool"><i class="fas fa-images"></i></span>
            </div>
        </div>

        <div class="card-body">

            <form wire:submit="saveImagenes">

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
                            <div class="col-8">
                                <img class="img-thumbnail" style="cursor: pointer;" src="{{ asset(verImagen($frontalSrcImagen)) }}" alt="Imagen Frontal" onclick="clickImgFrontal()" {{--width="101" height="100"--}} />
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
                                    <span class="text-sm text-bold text-danger text-center" style="cursor: pointer" wire:click="limpiar('frontal')">
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
                            <div class="col-8">
                                <img class="img-thumbnail" style="cursor: pointer;" src="{{ asset(verImagen($posteriorSrcImagen)) }}" alt="Imagen Posterior" onclick="clickImgPosterior()" {{--width="101" height="100"--}} />
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
                                    <span class="text-sm text-bold text-danger text-center" style="cursor: pointer" wire:click="limpiar('posterior')">
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
