<div>
    <div class="card text-center">
        <div class="card-title">
            <b> Register RFID</b>
        </div>
        <div class="card-body">
            <div class="row pb-2">
                <div class="col-6">
                    <div class="float-right">
                        RFID No:
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-left">
                        <input class="input" type="text" min="0" wire:model.defer='cardNo'>
                    </div>
                </div>
                <div class="col-12 text-center" wire:poll.1000ms='checkForRegisteringCard'>
                    @if ($scanToRegister != '')
                        <div class="py-1 pb-2" wire:click='useScannedNumber'>
                          <small>  Scan Value: {{ $scanToRegister }}</small>
                        </div>
                    @endif
                </div>

            </div>

            <div class="row pb-2">
                <div class="col-6">
                    <div class="float-right">
                        Username:
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-left">
                        <input class="input" type="text" min="0" wire:model.defer='username'>
                    </div>
                </div>
            </div>


            <div class="row pb-2">
                <div class="col-6">
                    <div class="float-right">
                        Amount:
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-left">
                        <input class="input" type="number" min="0" wire:model.defer='amount'>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="float-right">
                <a href="" wire:click='save' class="btn btn-success btn-sm px-3 mx-3">SAVE</a>
            </div>
        </div>
    </div>

</div>
