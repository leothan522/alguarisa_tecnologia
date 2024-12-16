<div class="row justify-content-center">
    <div id="div_municipios" class="col-md-6">
        @include('dashboard.territorio.table_municipios')
    </div>
    <div id="div_parroquias" class="col-md-6 d-none d-md-block">
        @include('dashboard.territorio.table_parroquias')
    </div>
</div>

<div class="row">
    @include('dashboard.territorio.form_municipios')
    @include('dashboard.territorio.show_municipios')
    @include('dashboard.territorio.form_parroquias')
    @include('dashboard.territorio.show_parroquias')
</div>
