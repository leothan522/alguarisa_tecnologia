<div class="row justify-content-center attachment-block p-3"
     x-data="{ uploading: false, progress: 0 }"
     x-on:livewire-upload-start="uploading = true"
     x-on:livewire-upload-finish="uploading = false; progress = 0"
     x-on:livewire-upload-cancel="uploading = false"
     x-on:livewire-upload-error="uploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
>

    <div class="d-none">
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" wire:model.live="photo" class="custom-file-input" id="customFileLang" lang="es" accept="image/jpeg, image/png">
                <label class="custom-file-label text-sm" for="customFileLang" data-browse="Elegir">Seleccionar Imagen</label>
            </div>
            <input type="text" wire:model.live="img_borrar_principal">
        </div>
    </div>

    <div class="col-md-6 mt-3 mb-3">
        <div class="text-center" style="cursor:pointer;">
            <img class="img-thumbnail" src="{{ asset(verImagen($srcImagen)) }}" alt="Logo Empesa" onclick="imgEmpresa()" {{--width="101" height="100"--}}   />
            @if($verImagen)
                <button type="button" class="btn badge text-danger position-absolute float-right"
                        wire:click="btnBorrarImagen">
                    <i class="fas fa-trash-alt"></i>
                </button>
            @endif
        </div>
    </div>
    <div class="col-12 text-center">
        @error('photo')
        <span class="text-sm text-bold text-danger">
                <i class="icon fas fa-exclamation-triangle"></i>
                 {{ $message }}
        </span>
        @enderror
    </div>

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
