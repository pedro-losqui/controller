<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileComponent extends Component
{
    public $user, $edit, $password, $password_confirm;

    protected $rules = [
        'password' => 'required',
        'password_confirm' => 'required|same:password',
    ];

    protected $validationAttributes = [
        'type' => 'perfeil de acesso',
        'password_confirm' => 'confirmação de senha'
    ];

    public function mount()
    {
        $this->edit == 0;
    }

    public function render()
    {
        return view('livewire.profile.profile-component');
    }

    public function swiEdit()
    {
        $this->user = User::find(Auth::user()->id);
        $this->edit = 1;
    }

    public function updatePass()
    {
        $this->validate();
        $this->user->password = $this->hashPass();
        $this->user->save();

        session()->flash('success', 'Sua senha foi alterada com sucesso.');
        return redirect()->to('/profile');
    }

    public function hashPass()
    {
        return Hash::make($this->password);
    }
}
