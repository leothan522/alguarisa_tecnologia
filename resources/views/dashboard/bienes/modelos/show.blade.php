<div class="col-12">
    <!-- Widget: user widget style 2 -->
    <div class="card card-navy">
        <div class="card-header">
            <h3 class="card-title">
                Ver Modelo
            </h3>

            <div class="card-tools">
                <button class="btn btn-tool" wire:click="btnCancelar">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
            </div>
        </div>
        <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <span class="nav-link">
                        Tipo <span class="float-right text-bold text-uppercase">{{ $verTipo }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Marca <span class="float-right text-bold text-uppercase">{{ $verMarca }}</span>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">
                        Modelo <span class="float-right text-bold">{{ $nombre }}</span>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.widget-user -->
</div>
