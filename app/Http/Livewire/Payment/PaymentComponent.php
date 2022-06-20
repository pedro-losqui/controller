<?php

namespace App\Http\Livewire\Payment;

use App\Models\Hour;
use App\Models\User;
use App\Models\Payment;
use Livewire\Component;
use App\Models\Consultant;

class PaymentComponent extends Component
{
    public $user_id, $consultant_id, $type_service, $customer, $hours, $payment, $status;

    public $consultants, $payment_id;

    public $action, $edit;

    public $search;

    protected $rules = [
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
        return view('livewire.payment.payment-component', [
            'payments' => Payment::all()
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
        $this->payment_id = Payment::find($id);

        $this->consultant_id = $this->payment_id->consultant_id;
        $this->type_service = $this->payment_id->type_service;
        $this->customer = $this->payment_id->customer;
        $this->hours = $this->payment_id->hours;
        $this->payment = $this->payment_id->payment;
        $this->status = $this->payment_id->status;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        $this->user_id = 1;

        Payment::create($this->validate());

        session()->flash('success', 'Pagemento criado com sucesso.');
        return redirect()->to('/payament');
    }

    public function update()
    {
        $this->payment_id->consultant_id = $this->consultant_id;
        $this->payment_id->type_service = $this->type_service;
        $this->payment_id->customer = $this->customer;
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
        $this->consultants = Consultant::all();
    }

    public function calcValue()
    {
        $hour = Hour::where('consultant_id', $this->consultant_id)
        ->orderBy('id', 'desc')
        ->first();
        $this->payment = $hour->value * $this->hours;
        $this->value = $hour->value;
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
