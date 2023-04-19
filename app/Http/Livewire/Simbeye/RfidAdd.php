<?php

namespace App\Http\Livewire\Simbeye;

use App\Models\MasterSetting;
use App\Models\Simbeye;
use Livewire\Component;

class RfidAdd extends Component
{
    public $cardId;
    public $input;
    public $cardNo;
    public $amount;
    public $username;
    public $usage;
    public $lastUsed;
    public $createdAt;
    public $scanToRegister;


    public function mount()
    {
        $this->scanToRegister = '';
        MasterSetting::where('code_name','rfid_to_register')->first()->update(['value'=>'']);
    }

    protected function rules()
    {
        return [
            'cardNo' => 'required|unique:simbeyes,card_no',
            'username' => 'required',
            'amount' => 'required|numeric|gt:0',
        ];
    }
    public function render()
    {
        return view('livewire.simbeye.rfid-add');
    }

    public function save()
    {
        $this->validate();
        Simbeye::create([
            'card_no'=>$this->cardNo,
            'username' => $this->username,
            'amount' => $this->amount
        ]);
        return redirect()->route('rfid');
    }

    public function checkForRegisteringCard()
    {
        $this->scanToRegister = MasterSetting::where('code_name','rfid_to_register')->first()->value;
    }

    public function useScannedNumber()
    {
        $this->cardNo = $this->scanToRegister;
        $this->scanToRegister = '';
        MasterSetting::where('code_name','rfid_to_register')->first()->update(['value'=>'']);
    }
    
}
