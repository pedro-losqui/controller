<?php

namespace App\Http\Livewire\Consultant;

use App\Models\Hour;
use App\Models\User;
use Livewire\Component;
use App\Models\Consultant;
use Illuminate\Support\Facades\Auth;

class ConsultantComponent extends Component
{
    public $company_id, $user_id, $bday, $pix, $cpf, $rg, $consultant, $users, $ids = [];

    public $date, $value, $hours;

    public $action, $edit;

    public $search;

    protected $listeners = ['save'];

    protected $rules = [
        'company_id' => 'required',
        'user_id' => 'required',
        'pix' => 'required',
        'bday' => 'required',
        'cpf' => 'required',
        'rg' => 'required',
    ];

    protected $validationAttributes = [
        'user_id' => 'usuário/consultor',
        'bday' => 'data de nascimento',
        'value' => 'valor/hora',
    ];

    public function mount()
    {
        $this->getConsultant();
        $this->getUsers();
        $this->action = 0;
        $this->edit = 0;
    }

    public function render()
    {
        if (Auth::user()->type == '0') {
            return view('livewire.consultant.consultant-component', [
                'consultants' => Consultant::whereHas('user', function($query){
                    $query->where('name', 'like', '%'. $this->search .'%');
                 })
                ->orderBy('id', 'DESC')
                ->get()
            ]);
        } else {
            return view('livewire.consultant.consultant-component', [
                'consultants' => Consultant::whereHas('user', function($query){
                    $query->where('name', 'like', '%'. $this->search .'%');
                 })
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
        $this->consultant = Consultant::find($id);

        $this->hours = Hour::where('consultant_id', $id)
        ->orderBy('id', 'DESC')
        ->get();

        $this->user_id = $this->consultant->user_id;
        $this->pix = $this->consultant->pix;
        $this->cpf = $this->consultant->cpf;
        $this->rg = $this->consultant->rg;
        $this->bday = $this->consultant->bday;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        $this->company_id = Auth::user()->company->id;
        $this->consultant = Consultant::create($this->validate());

        Hour::create([
            'company_id' =>  Auth::user()->company->id,
            'consultant_id' =>  $this->consultant->id,
            'value' => $this->value,
        ]);

        session()->flash('success', 'Consultor criado com sucesso.');
        return redirect()->to('/consultant');
    }

    public function update()
    {
        $this->consultant->pix = $this->pix;
        $this->consultant->cpf = $this->cpf;
        $this->consultant->rg = $this->rg;
        $this->consultant->bday = $this->bday;
        $this->consultant->save();

        session()->flash('success', 'Usuário alterado com sucesso.');
        return redirect()->to('/consultant');
    }

    public function updateHour()
    {
        Hour::create([
            'company_id' =>  Auth::user()->company->id,
            'consultant_id' =>  $this->consultant->id,
            'value' => $this->value,
        ]);


        return redirect()->to('/consultant');
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->default();
    }

    public function getConsultant()
    {
        if (Auth::user()->type == '0') {
            $consultant_id = Consultant::all();
        } else {
            $consultant_id = Consultant::where('company_id', Auth::user()->company->id)
            ->get();
        }


        foreach ($consultant_id as $item) {
            array_push($this->ids, $item->user_id);
        }

        return $this->ids;
    }

    public function getUsers()
    {
        if (Auth::user()->type == '0') {
            $this->users  = User::all();
        } else {
            $this->users  = User::where('company_id', Auth::user()->company->id)
            ->get();
        }
    }

    public function default()
    {
        $this->user_id = '';
        $this->pix = '';
        $this->cpf = '';
        $this->rg = '';
        $this->bday = '';
        $this->value = '';
        $this->consultant = '';
    }
}
