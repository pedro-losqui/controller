<?php

namespace App\Http\Livewire\Company;

use App\Models\Company;
use Livewire\Component;

class CompanyComponent extends Component
{
    public $company_id, $cnpj, $company, $start, $end, $status;

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
            'companies' => Company::where('company', 'like', '%'. $this->search .'%')
            ->orderBy('id', 'DESC')
            ->get()
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
        $this->company_id = Company::find($id);

        $this->cnpj = $this->company_id->cnpj;
        $this->company = $this->company_id->company;
        $this->start = $this->company_id->start;
        $this->end = $this->company_id->end;
        $this->status = $this->company_id->status;

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
        $this->company_id->cnpj = $this->cnpj;
        $this->company_id->company = $this->company;
        $this->company_id->start = $this->start;
        $this->company_id->end = $this->end;
        $this->company_id->status = $this->status;

        $this->company_id->save();

        session()->flash('success', 'Empresa alterado com sucesso.');
        return redirect()->to('/company');
    }

    public function toUpp()
    {
        return $this->company = strtoupper($this->company);
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
