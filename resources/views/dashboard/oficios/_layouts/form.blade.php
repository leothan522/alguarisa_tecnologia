<form wire:submit="save">
    <div class="card card-navy">
        <div class="card-header">
            <h3 class="card-title">Nuevo Oficio</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Buscar Serial" {{--wire:model="keyword"--}} required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <div wire:ignore>
                <div class="form-group">
                    <label>Dirigido a:</label>
                    <select class="select2" multiple="multiple" data-placeholder="Seleccione" style="width: 100%;"></select>
                </div>
            </div>

            <div wire:ignore>
                <div class="form-group">
                    <label>Con copia a:</label>
                    <select class="select2" multiple="multiple" data-placeholder="Seleccione" style="width: 100%;"></select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Nro. Oficio:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-bookmark"></i></span>
                            </div>
                            <input type="text" class="form-control" {{--wire:model="oficio"--}} placeholder="Nro. Oficio" >
                            @error('oficio')
                                <span class="col-sm-12 text-sm text-bold text-danger">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        @error('oficio')
                            <div class="form-check m-2">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" {{--wire:click="btnRepetido"--}}>
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
                            <input type="date" class="form-control" {{--wire:model="fecha"--}} placeholder="alfanumérico" >
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
            </div>

            <div class="card card-navy card-outline">

                <div class="card-body table-responsive p-0" @if($equipos > 3) style="height: 30vh;" @endif >

                    <table class="table <!--table-head-fixed--> table-hover text-nowrap sticky-top">
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
                            @foreach($listarEquipos as $key => $equipo)
                                <li>
                                    <small class="text text-uppercase">
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
                                    <div class="tools text-danger" {{--wire:click="btnQuitarEquipo({{ $key }})"--}}>
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

            <div class="form-group">
                <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Adjuntar PDF
                    <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="float-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
            <button type="reset" class="btn btn-default" wire:click="limpiar">
                <i class="fas fa-times"></i> Descartar
            </button>
        </div>
    </div>
</form>


