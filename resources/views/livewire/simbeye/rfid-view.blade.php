<div class="card text-center">
    {{-- <div class="card-header">
      {{ $username }}
    </div> --}}
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="float-right">
                    RFID No:
                </div>
            </div>
            <div class="col-6">
                <div class="float-left">
                    <b>{{ $cardNo }}</b>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="float-right">
                    Username:
                </div>
            </div>
            <div class="col-6">
                <div class="float-left">
                    <b>{{ $username }}</b>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-6">
                <div class="float-right">
                    Usage:
                </div>
            </div>
            <div class="col-6">
                <div class="float-left">
                    <b>{{ $usage }}</b>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="float-right">
                    Last used:
                </div>
            </div>
            <div class="col-6">
                <div class="float-left">
                    <b>{{ $lastUsed }}</b>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="float-right">
                    Created at:
                </div>
            </div>
            <div class="col-6">
                <div class="float-left">
                    <b>{{ $createdAt }}</b>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="float-right">
                    Amount:
                </div>
            </div>
            <div class="col-6">
                <div class="float-left">
                    <input class="input" type="number" min="0" wire:model.defer='amount'>
                    @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        {{-- <h5 class="card-title">Special title treatment</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
       --}}
    </div>
    <div class="card-footer text-muted">
        <div class="float-right">
            <a  href="" wire:click='save' class="btn btn-success btn-sm px-3 mx-3">SAVE</a>
            <a href="#" wire:click='delete' class="btn btn-danger btn-sm px-3">DELETE</a>
        </div>
    </div>
</div>
