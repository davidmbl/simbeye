<?php

namespace App\Http\Livewire\Simbeye;

use Livewire\Component;
use App\Models\MasterSetting;

class RfidPrice extends Component
{
    public $cost;

    public function mount()
    {
        $this->cost = intval(MasterSetting::where('code_name','simbeye_cost')->first()->value);
    }

    public function render()
    {
        return view('livewire.simbeye.rfid-price');
    }

    public function updated($propertyName)
    {
        $setting = MasterSetting::where('code_name','simbeye_cost')->first();
        if (is_numeric($this->cost) && $this->cost >= 0) {
            $setting->value = strval($this->cost);
            $setting->save();
        }else{
            $this->cost = intval($setting->value);
        }
    }
}
