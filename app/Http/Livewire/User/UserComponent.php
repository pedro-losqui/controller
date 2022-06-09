<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserComponent extends Component
{
    public $action;

    public function mount()
    {
        $this->action = 0;
    }

    public function render()
    {
        return view('livewire.user.user-component');
    }

    public function swiView()
    {
        $this->action = 0;
    }

    public function swiCreate()
    {
        $this->action = 1;
    }

    public function save()
    {
        # code...
    }

    public function edit()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function default()
    {
        # code...
    }
}
