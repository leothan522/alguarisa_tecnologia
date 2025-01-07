<div class="row justify-content-center">

    <div class="col-md-4 col-lg-3 d-none d-md-block">
        @include('dashboard.oficios._layouts.cards')
    </div>

    <div class="col-md-8 col-lg-9">

        <div class="@if($view != 'table') d-none @endif">
            @include('dashboard.oficios._layouts.table')
        </div>

        <div class="@if($view != 'show') d-none @endif">
            @include('dashboard.oficios._layouts.show')
        </div>

        <div class="@if($view != 'form') d-none @endif">
            @include('dashboard.oficios._layouts.form')
        </div>

    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 d-md-none">
        @include('dashboard.oficios._layouts.cards')
    </div>
</div>




