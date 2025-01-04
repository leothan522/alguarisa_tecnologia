<!-- Button trigger modal -->
{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
    Launch static backdrop modal
</button>--}}

<!-- Modal -->
<form wire:submit="login">
    <div wire:ignore.self class="modal fade" id="modal_login" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true" xmlns:wire="http://www.w3.org/1999/xhtml">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-navy">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <h5 class="modal-title" id="staticBackdropLabel">Iniciar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" wire:loading.class="invisible">
                    <div class="row justify-content-center">

                        @error('login_validacion')
                        <div class="col-12">
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i>¡Alerta!</h5>
                                <p class="text-justify">
                                    {{ $message }}
                                </p>
                            </div>
                        </div>
                        @enderror

                        <div class="col-12">

                            <div class="form-group">
                                <small class="text-lightblue text-bold text-uppercase">{{ __('Email') }}:</small>
                                <div class="input-group">
                                    <input type="email" wire:model="login_email" class="form-control @error('login_email') is-invalid @enderror" placeholder="{{ __('Email') }}">
                                    @error('login_email')
                                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <small class="text-lightblue text-bold text-uppercase">{{ __('Password') }}:</small>
                                <div class="input-group">
                                    <input type="password" wire:model="login_password" class="form-control @error('login_password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                                    @error('login_password')
                                    <span class="error invalid-feedback text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <div class="modal-footer" wire:loading.class="">

                    <button type="button" class="btn btn-default mr-2" data-dismiss="modal" id="btn_modal_login_cerrar"  wire:loading.remove>
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary float-right"  wire:loading.remove>
                        INICIAR SESIÓN
                    </button>
                    <button type="button" class="btn btn-primary float-right" wire:loading disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        CARGANDO...
                    </button>
                </div>
                {!! verSpinner()  !!}

            </div>
        </div>
    </div>
</form>
