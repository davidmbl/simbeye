<div>
    @if ($cardNo == null)
        <div class="center-div">
            <div class="inputbox">
                <input wire:model.debounce.1000ms='input' required="required" type="text">
                <span>Enter Card Number</span>
                <i></i>
            </div>
            <div class="checker">
                <div class="spinner-grow" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    @else
        <div wire:poll.2000ms='updateCard'>
            @if ($createdAt == null)
                <div class="checker">
                    <div class="spinner-grow" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            @else
                <div class="head-content">
                    <span class="greetings">Welcome, </span>
                    <span class="username"> {{ $username }}</span>
                    <p class="card-no">{{ $cardNo }}</p>
                </div>
                <div class="wrapper">
                    <div class="my-container">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span class="num">{{ number_format($amount) }}</span>
                        <span class="text">Amount left (Tsh)</span>
                    </div>

                    <div class="my-container">
                        <i class="fa-solid fa-person-walking"></i>
                        <span class="num">{{ $usage }}</span>
                        <span class="text">Card usage</span>
                    </div>

                    <div class="my-container">
                        <i class="fa-regular fa-clock"></i>
                        <span class="num" data-val="225">{{ $lastUsed }}</span>
                        <span class="text">Last Used</span>
                    </div>

                    <div class="my-container">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="num" data-val="280">{{ $createdAt }}</span>
                        <span class="text">Date created</span>
                    </div>
                </div>
            @endif
        </div>

    @endif
</div>
