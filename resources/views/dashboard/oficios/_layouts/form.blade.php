<div class="card card-navy">

    <div class="card-header">
        <h3 class="card-title">Nuevo Oficio</h3>
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

    <form wire:submit="save">

        <div class="card-body">

            <div class="form-group">
                <label>Dirigido a:</label>
                {{--{!! json_encode($dirigido) !!}--}}
                <div wire:ignore>
                    <div id="div_select_dirigido_a">
                        <select class="custom-control custom-select">
                            <option>Seleccione</option>
                        </select>
                    </div>
                </div>
                @error('dirigido')
                <span class="col-sm-12 text-sm text-bold text-danger">
                    <i class="icon fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label>Con copia a:</label>
                {{--{!! json_encode($copia) !!}--}}
                <div wire:ignore>
                    <div id="div_select_con_copia_a">
                        <select class="custom-control custom-select">
                            <option>Seleccione</option>
                        </select>
                    </div>
                </div>
                @error('copia')
                <span class="col-sm-12 text-sm text-bold text-danger">
                    <i class="icon fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </span>
                @enderror
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Nro. Oficio:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                            </div>
                            <input type="text" class="form-control" wire:model="numero" placeholder="Nro. Oficio">
                            @error('numero')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Fecha:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                            </div>
                            <input type="date" class="form-control" wire:model="fecha" placeholder="alfanumérico">
                            @error('fecha')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div wire:ignore>
                    <textarea id="adicional" class="form-control" style="height: 300px;">
                        {{--{{ $adicional }}--}}
                    </textarea>
                </div>
                @error('adicional')
                <span class="col-sm-12 text-sm text-bold text-danger">
                    <i class="icon fas fa-exclamation-triangle"></i>
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="card card-navy card-outline">

                <div class="card-body table-responsive p-0" style="max-height: 30vh;" >

                    <table class="table table-head-fixed table-hover text-nowrap sticky-top">
                        <thead>
                        <tr class="text-navy">
                            {{--<th style="width: 10%">Código</th>--}}
                            <th>
                                Equipos
                                <small class="float-right">Cantidad {{ $equipos }}</small>
                            </th>
                        </tr>
                        </thead>
                    </table>

                    <!-- TO DO List -->
                    <ul class="todo-list" data-widget="todo-list">
                        @if(!empty($listarEquipos))
                            @php($i = 0)
                            @foreach($listarEquipos as $key => $equipo)
                                @php($i++)
                                <li>
                                    <small class="text text-uppercase">
                                        <small class="text-navy">{{ $i }}.&nbsp;-&nbsp;</small>
                                        {{ $equipo['tipo'] }}
                                        {{ $equipo['marca'] }}
                                        {{ $equipo['modelo'] }}
                                        @if(!is_null($equipo['serial']))
                                            , Serial: {{ $equipo['serial'] }}
                                        @endif
                                        @if(!is_null($equipo['identificador']))
                                            , Identificador: {{ $equipo['identificador'] }}
                                        @endif
                                    </small>
                                    <!-- General tools such as edit or delete-->
                                    <div class="tools text-danger" wire:click="btnQuitarEquipo({{ $key }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="text-center">
                                <span class="text">Sin Equipos vinculados</span>
                            </li>
                        @endif

                    </ul>

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

                <p class="help-block">Max. 5MB</p>


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



