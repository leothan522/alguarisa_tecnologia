<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Tipo:</small>
    <div wire:ignore>
        <div id="div_select_bienes_tipo" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('tipo')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Marca:</small>
    <div wire:ignore>
        <div id="div_select_bienes_marca" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('marca')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Modelo:</small>
    <div wire:ignore>
        <div id="div_select_bienes_modelo" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('modelo')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Color:</small>
    <div wire:ignore>
        <div id="div_select_bienes_color" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('color')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>



