<?php

namespace App\Http\Livewire\Simbeye;

use App\Models\Simbeye;
use Carbon\Carbon;
use Livewire\Component;

class User extends Component
{
    //card details
    public $input;
    public $cardNo;
    public $amount;
    public $username;
    public $usage;
    public $lastUsed;
    public $createdAt;

    public function mount()
    {

    }

    public function updateCard()
    {
        if(!$this->cardNo){
            return;
        }
        $card = Simbeye::where('card_no',$this->cardNo)->first();
        $this->cardNo = $card->card_no;
        $this->username = $card->username;
        $this->amount = $card->amount;
        $this->usage = $card->usage;
        $this->lastUsed =$card->last_used==null?'N/A':Carbon::parse($card->last_used)->format('H:i, d/M/y');
        $this->createdAt = Carbon::parse($card->created_at)->format('H:i, d/M/y');
    }

    public function render()
    {
        return view('livewire.simbeye.user');
    }

    public function lookup()
    {
        // sleep(2);
        $exists = Simbeye::where('card_no',$this->input)->exists();
        if($exists){
            $this->cardNo = $this->input;
        }else{

        }
    }

    public function updated()
    {
        $this->lookup();
    }

}
