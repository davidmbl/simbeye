<?php

namespace App\Http\Livewire\Simbeye;

use App\Models\Simbeye;
use Carbon\Carbon;
use Livewire\Component;

class RfidView extends Component
{
    public $cardId;
    public $input;
    public $cardNo;
    public $amount;
    public $username;
    public $usage;
    public $lastUsed;
    public $createdAt;

    public function mount($id)
    {
        $card = Simbeye::find($id);
        $this->cardId = $id; 
        $this->cardNo = $card->card_no;
        $this->username = $card->username;
        $this->amount = $card->amount;
        $this->usage = $card->usage;
        $this->lastUsed = $card->last_used == null ? 'N/A' : Carbon::parse($card->last_used)->format('H:i, d/M/y');
        $this->createdAt = Carbon::parse($card->created_at)->format('H:i, d/M/y');
    }

    public function render()
    {
        return view('livewire.simbeye.rfid-view');
    }

    protected function rules()
    {
        return [
            'amount' => 'required|numeric|gt:0',
        ];
    }

    public function save()
    {
        if (is_numeric($this->amount) && $this->amount >= 0) {
            $card = Simbeye::find($this->cardId);
            $card->amount = $this->amount;
            $card->save();
            return redirect()->route('rfid');
        }
    }

    public function delete()
    {
        $card = Simbeye::find($this->cardId);
        $card->delete();
        return redirect()->route('rfid');
    }
}
