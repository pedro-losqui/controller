<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class CompanyComponent extends Component
{
    public $compan_id, $cnpj, $company, $start, $end, $status;

    public $action, $edit;

    public $search;

    protected $rules = [
        'cnpj' => 'required|unique:companies',
        'company' => 'required',
        'start' => 'required',
        'end' => 'required',
        'status' => 'required',
    ];

    protected $validationAttributes = [
        'company' => 'razão social',
        'start' => 'data de inicio',
        'end' => 'data de término'
    ];

    public function mount()
    {
        $this->action = 0;
        $this->edit = 0;
    }

    public function render()
    {
        return view('livewire.company.company-component', [
            'companies' => Company::all()
        ]);
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
        $this->toUpp();

        Company::create($this->validate());

        session()->flash('success', 'Empresa criada com sucesso.');
        return redirect()->to('/company');
    }

    public function update()
    {
        $this->user->name = $this->firstUpp();
        $this->user->email = $this->email;
        $this->user->status = $this->status;
        $this->user->type = $this->type;

        if ($this->resPass == 1) {
            $this->user->password = $this->hashPass();
        }

        $this->user->save();

        session()->flash('success', 'Empresa alterado com sucesso.');
        return redirect()->to('/company');
    }

    public function toUpp()
    {
        return mb_strtoupper($this->company, 'UTF-8');
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->default();
    }

    public function default()
    {
        $this->cnpj = '';
        $this->company = '';
        $this->start = '';
        $this->end = '';
        $this->status = '';
        $this->company_id = '';
    }
}
