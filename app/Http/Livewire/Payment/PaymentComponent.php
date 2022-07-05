<?php

namespace App\Http\Livewire\Payment;

use App\Models\Hour;
use App\Models\User;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Consultant;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PaymentComponent extends Component
{
    use WithPagination;

    public $company_id, $user_id, $cons_id, $consultant_id, $type_service, $customer, $value, $hours, $payment, $status;

    public $consultants, $payment_id;

    public $action, $edit;

    public $search;

    protected $rules = [
        'company_id' => 'required',
        'user_id' => 'required',
        'consultant_id' => 'required',
        'type_service' => 'required',
        'customer' => 'required',
        'value' => 'required',
        'hours' => 'required',
        'payment' => 'required',
        'status' => 'required',
    ];

    protected $validationAttributes = [
        'consultant_id' => 'usuário/consultor',
        'type_service' => 'tipo de serviço',
        'customer' => 'cliente',
        'hours' => 'horas',
        'status' => 'status',
    ];

    public function updated()
    {
        if ($this->consultant_id && $this->hours) {
            $this->calcValue();
        }
    }

    public function mount()
    {
        $this->getConsultant();
        $this->action = 0;
        $this->edit = 0;
    }

    public function render()
    {
        switch (Auth::user()->type) {
            case '0':
                return view('livewire.payment.payment-component', [
                    'payments' => Payment::where('consultant_id',  $this->cons_id)
                    ->paginate(20)
                ]);
                break;

            case '1':
                if ($this->cons_id) {
                    return view('livewire.payment.payment-component', [
                        'payments' => Payment::where('consultant_id',  $this->cons_id)
                        ->where('company_id',  Auth::user()->company->id)
                        ->paginate(20)
                    ]);
                } else {
                    return view('livewire.payment.payment-component', [
                        'payments' => Payment::where('company_id',  Auth::user()->company->id)
                        ->paginate(20)
                    ]);
                }

                break;

            case '2':
                return view('livewire.payment.payment-component', [
                    'payments' => Payment::where('consultant_id',  Auth::user()->consultant->id)
                    ->paginate(20)
                ]);
                break;
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
        $this->payment_id = Payment::find($id);

        $this->consultant_id = $this->payment_id->consultant_id;
        $this->type_service = $this->payment_id->type_service;
        $this->customer = $this->payment_id->customer;
        $this->value = $this->payment_id->value;
        $this->hours = $this->payment_id->hours;
        $this->payment = $this->payment_id->payment;
        $this->status = $this->payment_id->status;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        $this->company_id = Auth::user()->company->id;
        $this->user_id = 1;

        Payment::create($this->validate());

        session()->flash('success', 'Pagemento criado com sucesso.');
        return redirect()->to('/payament');
    }

    public function update()
    {
        $this->payment_id->company_id = Auth::user()->company->id;
        $this->payment_id->consultant_id = $this->consultant_id;
        $this->payment_id->type_service = $this->type_service;
        $this->payment_id->customer = $this->customer;
        $this->payment_id->value = $this->value;
        $this->payment_id->hours = $this->hours;
        $this->payment_id->payment = $this->payment;
        $this->payment_id->status = $this->status;

        $this->payment_id->save();

        session()->flash('success', 'Pagamento alterado com sucesso.');
        return redirect()->to('/payment');
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->default();
    }

    public function getConsultant()
    {
        $this->consultants = Consultant::where('company_id', Auth::user()->company->id)
        ->get();
    }

    public function calcValue()
    {
        if ($this->edit == 0) {
            $hour = Hour::where('consultant_id', $this->consultant_id)
            ->orderBy('id', 'desc')
            ->first();
            $this->payment = $hour->value * $this->hours;
            $this->value = $hour->value;
        }else{
            $this->payment = $this->payment_id->value * $this->hours;
            $this->value = $this->payment_id->value;
        }
    }

    public function default()
    {
        $this->user_id = '';
        $this->consultant_id = '';
        $this->type_service = '';
        $this->customer = '';
        $this->hours = '';
        $this->payment = '';
        $this->status = '';
        $this->consultant = '';
    }
}
