<?php

namespace App\Http\Livewire\Hour;

use App\Models\Hour;
use Livewire\Component;

class HourComponent extends Component
{
    public $consultant_id, $date, $value;

    protected $listeners = ['save'];

    public function render()
    {
        return view('livewire.hour.hour-component');
    }
}
