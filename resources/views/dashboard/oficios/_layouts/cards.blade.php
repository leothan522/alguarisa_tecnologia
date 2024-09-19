@if($view == 'show' || $view == 'form')
    <button type="button" class="btn btn-primary btn-block mb-3" wire:click="limpiar">
        <i class="fas fa-arrow-left"></i> Volver a Oficios
    </button>
@else
    <button type="button" class="btn btn-primary btn-block mb-3" wire:click="create">
        <i class="fas fa-file"></i> Nuevo Oficio
    </button>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Carpetas</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item active">
                <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> Bienes
                    <span class="badge bg-warning float-right">12</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-filter"></i> Terceros
                    <span class="badge bg-warning float-right">65</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tablas</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <button type="button" class="btn nav-link">
                    <i class="fas fa-user-tag text-primary"></i> Personas
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn nav-link" data-toggle="modal" data-target="#modal-instituciones">
                    <i class="fas fa-university text-primary"></i> Instituciones
                </button>
            </li>

            {{--<li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle text-danger"></i>
                    Por verificar
                </a>
            </li>--}}
        </ul>
    </div>
    <!-- /.card-body -->
</div>
