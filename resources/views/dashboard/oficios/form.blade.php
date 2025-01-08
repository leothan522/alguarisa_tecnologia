<div class="card card-navy card-outline">

    <div class="card-header">

        <div class="row p-0">
            <div class="col-7 col-sm-8 col-md-9 p-0">
                <h3 class="card-title">
                    @if($oficios_id)
                        Editar
                    @else
                        Nuevo
                    @endif
                    Oficio
                </h3>
            </div>

            <div class="col-5 col-sm-4 col-md-3 p-0">
                <div class="card-tools">
                    <form wire:submit="searchSerial">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Buscar Serial" wire:model="serial" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <form wire:submit="save">

        <div class="card-body table-responsive" style="min-height: calc(100vh - {{ $size }}px); max-height: calc(100vh - {{ $size }}px)">

            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">Dirigido a:</small>
                {{--{!! json_encode($dirigido) !!}--}}
                <div wire:ignore>
                    <div id="div_select_dirigido_a" class="select2-purple">
                        <select class="custom-control custom-select">
                            <option>Seleccione</option>
                        </select>
                    </div>
                </div>
                @error('dirigido')
                    <small class="text-danger text-bold">{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group">
                <small class="text-lightblue text-bold text-uppercase">Con copia a:</small>
                {{--{!! json_encode($copia) !!}--}}
                <div wire:ignore>
                    <div id="div_select_con_copia_a" class="select2-purple">
                        <select class="custom-control custom-select">
                            <option>Seleccione</option>
                        </select>
                    </div>
                </div>
                @error('copia')
                    <small class="text-danger text-bold">{{ $message }}</small>
                @enderror
            </div>


            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Nro. Oficio:</small>
                        <div class="input-group">
                            <input type="text" wire:model="numero" class="form-control @error('numero') is-invalid @enderror"  placeholder="Nro. Oficio">
                            @error('numero')
                                <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        @error('numero')
                        <div class="form-check m-2">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:click="btnRepetido">
                            <label class="form-check-label" for="exampleCheck1">Repetido</label>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <small class="text-lightblue text-bold text-uppercase">Fecha:</small>
                        <div class="input-group mb-3">
                            <input type="date" wire:model="fecha" class="form-control @error('fecha') is-invalid @enderror" placeholder="Fecha">
                            @error('fecha')
                                <span class="error invalid-feedback text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div wire:ignore>
                    <textarea id="adicional" class="form-control" placeholder="hola" {{--style="height: 300px;"--}}>
                        {{--{{ $adicional }}--}}
                    </textarea>
                </div>
                @error('adicional')
                    <small class="text-danger text-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="card card-lightblue card-outline">
                <div class="card-body table-responsive p-0" style="max-height: 30vh;">
                    <div class="col-12 bg-light sticky-top">
                        <small class="text-lightblue text-bold text-uppercase pl-4">Equipos:</small>
                        <small class="float-right text-bold text-uppercase pr-4">{{ $equipos }}</small>
                    </div>
                    @include('dashboard.oficios.table_equipos')
                </div>
            </div>

            <div class="form-group"
                 x-data="{ uploading: false, progress: 0 }"
                 x-on:livewire-upload-start="uploading = true"
                 x-on:livewire-upload-finish="uploading = false; progress = 0"
                 x-on:livewire-upload-cancel="uploading = false"
                 x-on:livewire-upload-error="uploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress"
            >

                <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Adjuntar PDF
                    <input type="file" name="attachment" wire:model="pdf" accept="application/pdf" id="input_file_pdf">
                </div>

                <p class="help-block">Max. 10MB</p>


                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li @if(!$verIconoPDF) class="d-none" @endif >
                        <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                        <div class="mailbox-attachment-info">
                            <a class="mailbox-attachment-name">
                                <i class="fas fa-paperclip"></i>
                                <span>{{ $nombrePDF }}</span>
                            </a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                              <span>{{ formatoMillares($sizePDF, 0) }} KB</span>
                                <button type="button" class="btn btn-default btn-sm float-right" wire:click="btnResetPDF">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </span>
                        </div>
                    </li>
                </ul>


                @error('pdf')
                <span class="col-sm-12 text-sm text-bold text-danger" wire:click="btnResetPDF" style="cursor:pointer;">
                    <i class="icon fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </span>
                @enderror

                <div class="row justify-content-center mt-2">
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

        <div class="card-footer">
            <div class="float-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
            <button type="reset" class="btn btn-default" wire:click="btnDescartar">
                <i class="fas fa-times"></i> Descartar
            </button>
        </div>

    </form>

    <div class="overlay-wrapper" wire:loading wire:target="save, searchSerial, btnQuitarEquipo, btnResetPDF, limpiar, btnDescartar">
        <div class="overlay">
            <div class="spinner-border text-navy" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>

</div>



