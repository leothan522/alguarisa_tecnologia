<div class="row">

    <div class="col-md-6">

        <div class="card card-outline card-navy">

            <div class="card-header">
                <h5 class="card-title">Horario de la Tienda</h5>
                <div class="card-tools">
                    <div class="custom-control custom-switch custom-switch-on-success float-right">
                        <input type="checkbox" class="custom-control-input" id="customSwitchHours"
                               @if($horario) checked @endif wire:click="setHorario">
                        <label class="custom-control-label" for="customSwitchHours" role="button"></label>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <h1 class="profile-username text-center text-bold text-uppercase">
                    {{ $nombre }}
                </h1>

                <div class="input-group">
                    <label class="text-muted">Dias Activos</label>
                </div>

                <div class="input-group">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="checkbox" role="button" @if($lunes) checked
                                     @endif wire:click="diasActivos('Mon', {{ $lunes }})">
                            </span>
                    </div>
                    <label class="form-control">Lunes</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" role="button" @if($martes) checked
                                 @endif wire:click="diasActivos('Tue', {{ $martes }})">
                        </span>
                    </div>
                    <label class="form-control">Martes</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" role="button" @if($miercoles) checked
                                 @endif wire:click="diasActivos('Wed', {{ $miercoles }})">
                        </span>
                    </div>
                    <label class="form-control">Miercoles</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" role="button" @if($jueves) checked
                                 @endif wire:click="diasActivos('Thu', {{ $jueves }})">
                        </span>
                    </div>
                    <label class="form-control">Jueves</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" role="button" @if($viernes) checked
                                 @endif wire:click="diasActivos('Fri', {{ $viernes }})">
                        </span>
                    </div>
                    <label class="form-control">Viernes</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" role="button" @if($sabado) checked
                                 @endif wire:click="diasActivos('Sat', {{ $sabado }})">
                        </span>
                    </div>
                    <label class="form-control">Sabado</label>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                          <input type="checkbox" role="button" @if($domingo) checked
                                 @endif wire:click="diasActivos('Sun', {{ $domingo }})">
                        </span>
                    </div>
                    <label class="form-control">Domingo</label>
                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card card-outline card-navy">

            <div class="card-header">
                <h5 class="card-title">Rango Horas</h5>
                <div class="card-tools">
                    <span class="btn-tool"><i class="fas fa-clock"></i></span>
                </div>
            </div>

            <div class="card-body">

                <form class="row" wire:submit="storeHoras">

                    @include('dashboard.empresas.estatus')

                    <div class="col-12 form-group">
                        <label for="email">Apertura</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="time" wire:model="apertura">
                            @error('apertura')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="email">Cierre</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="time" wire:model="cierre">
                            @error('cierre')
                            <span class="col-sm-12 text-sm text-bold text-danger">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="float-right">
                            <button type="submit" class="btn btn-block btn-success">
                                <i class="fas fa-save"></i> Guardar Horas
                            </button>
                        </div>
                    </div>

                </form>

            </div>

        </div>


    </div>


</div>
