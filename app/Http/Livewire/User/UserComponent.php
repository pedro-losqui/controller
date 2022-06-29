<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserComponent extends Component
{
    use AuthorizesRequests;

    public $name, $email, $password, $password_confirm, $status, $type, $user;

    public $action, $edit, $resPass, $companies, $company_id;

    public $search;

    protected $rules = [
        'name' => 'required|min:4',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'password_confirm' => 'required|same:password',
        'type' => 'required',
        'company_id' => '',
    ];

    protected $validationAttributes = [
        'type' => 'perfeil de acesso',
        'password_confirm' => 'confirmação de senha'
    ];

    public function mount()
    {
        $this->getCompany();
        $this->resPass = 0;
        $this->action = 0;
        $this->edit = 0;
    }

    public function render()
    {
        if (Auth::user()->type == '0') {
            return view('livewire.user.user-component', [
                'users' => User::where('name', 'like', '%'. $this->search .'%')
                ->orderBy('id', 'DESC')
                ->get()
            ]);
        } else {
            return view('livewire.user.user-component', [
                'users' => User::where('name', 'like', '%'. $this->search .'%')
                ->where('company_id', Auth::user()->company->id)
                ->orderBy('id', 'DESC')
                ->get()
            ]);
        }

    }

    public function swiView()
    {
        $this->action = 0;
    }

    public function swiCreate()
    {
        $this->default();
        $this->edit = 0;
        $this->action = 1;
    }

    public function swiEdit($id)
    {
        $this->user = User::find($id);

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->status = $this->user->status;
        $this->type = $this->user->type;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        $this->validate();

        User::create([
            'company_id' => $this->checkCompany(),
            'name' => $this->firstUpp(),
            'email' => $this->email,
            'password' => $this->hashPass(),
            'status' => '1',
            'type' => $this->type,
        ]);

        session()->flash('success', 'Usuário criado com sucesso.');
        return redirect()->to('/user');
    }

    public function update()
    {
        $this->user->company_id = $this->checkCompany();
        $this->user->name = $this->firstUpp();
        $this->user->email = $this->email;
        $this->user->status = $this->status;
        $this->user->type = $this->type;

        if ($this->resPass == 1) {
            $this->user->password = $this->hashPass();
        }

        $this->user->save();

        session()->flash('success', 'Usuário alterado com sucesso.');
        return redirect()->to('/user');
    }

    public function checkCompany()
    {
        if (empty($this->company_id)) {
            return Auth::user()->company->id;
        }

        return $this->company_id;
    }

    public function getCompany()
    {
        $this->companies = Company::all();
    }

    public function firstUpp()
    {
        return ucwords(mb_strtolower($this->name, 'UTF-8'));
    }

    public function resPass()
    {
        $this->resPass = 1;
        $this->password = $this->gerPass();
    }

    public function hashPass()
    {
        return Hash::make($this->password);
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->default();
    }

    public function gerPass($qtyCaraceters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $specialCharacters = str_shuffle('!@#$%*-');

        $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;

        $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

        return $password;
    }

    public function default()
    {
        $this->company_id = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->status = '';
        $this->type = '';
        $this->user = '';
    }
}
