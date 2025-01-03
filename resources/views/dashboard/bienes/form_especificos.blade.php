<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">serial:</small>
    <div class="input-group">
        <input type="text" wire:model="serial" class="form-control @error('serial') is-invalid @enderror" placeholder="Serial">
        @error('serial')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Identificador:</small>
    <div class="input-group">
        <input type="text" wire:model="identificador" class="form-control @error('identificador') is-invalid @enderror" placeholder="Identificador">
        @error('identificador')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Condición:</small>
    <div wire:ignore>
        <div id="div_select_bienes_condicion" class="input-group">
            <select class="custom-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </div>
    @error('condicion')
    <small class="text-danger text-bold">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <small class="text-lightblue text-bold text-uppercase">Información Adicional:</small>
    <div class="input-group">
        <textarea class="form-control @error('adicional') is-invalid @enderror" wire:model="adicional" placeholder="Información Adicional (Opcional)"></textarea>
        @error('adicional')
        <span class="error invalid-feedback text-bold">{{ $message }}</span>
        @enderror
    </div>
</div>




