<div>
    <div class="row mx-4">
        <div class="col-6">
            <div class="float-right">
                Cost per Scan:
            </div>
        </div>
        <div class="col-6">
            <div class="float-left">
                <input class="input" type="number" min="0" wire:model.lazy='cost'>
                @error('cost')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
