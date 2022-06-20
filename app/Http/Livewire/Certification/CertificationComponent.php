<?php

namespace App\Http\Livewire\Certification;

use App\Models\Iten;
use App\Models\Block;
use App\Models\Product;
use Livewire\Component;
use App\Models\Consultant;
use App\Models\Certification;

class CertificationComponent extends Component
{
    public $certification, $cons_id, $consultant_id, $iten_id, $percent_block, $status_block, $status_iten;

    public $consultants, $products, $product_id, $blocks, $block_id, $itens;

    public $action, $edit;

    public $search;

    protected $rules = [
        'consultant_id' => 'required',
        'product_id' => 'required',
        'block_id' => 'required',
        'iten_id' => 'required',
    ];

    protected $validationAttributes = [
        'product_id' => 'produto',
        'consultant_id' => 'consultor',
        'block_id' => 'bloco',
        'iten_id' => 'itens',
    ];

    public function mount()
    {
        $this->getConsultant();
        $this->getProduct();
        $this->getBlock();
        $this->action = 0;
        $this->edit = 0;
    }

    public function updated()
    {
        if ($this->block_id && $this->block_id) {
            $this->getIten();
        }
    }

    public function render()
    {
        return view('livewire.certification.certification-component', [
            'certifications' => Certification::where('consultant_id',  $this->cons_id)
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
        $this->certifiction = Certification::find($id);

        $this->status_iten = $this->certifiction->status_iten;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        if ($this->iten_id == 0) {
            $this->saveAll();
        } else {
            Certification::create($this->validate());

            session()->flash('success', 'Certificação criado com sucesso.');
            return redirect()->to('/certification');
        }

    }

    public function saveAll()
    {
        $this->validate();
        foreach ($this->itens as $key => $value) {
            Certification::create([
                'consultant_id' => $this->consultant_id,
                'block_id' => $this->block_id,
                'iten_id' => $value->id,
            ]);
        }

        session()->flash('success', 'Certificações criadas com sucesso.');
        return redirect()->to('/certification');
    }

    public function update()
    {
        $this->certifiction->status_iten = $this->status_iten;
        $this->certifiction->save();
        $this->updateProgress();

        session()->flash('success', 'Cerficação alterado com sucesso.');
        return redirect()->to('/certification');
    }

    public function updateProgress()
    {
        $consultant = Certification::where('consultant_id', $this->certifiction->consultant_id)
        ->where('block_id', $this->certifiction->block_id)
        ->get();

        $certification = count(Certification::where('consultant_id', $this->certifiction->consultant_id)
        ->where('status_iten', '1')
        ->get());

        $itens = count(Iten::where('block_id', $this->certifiction->block_id)
        ->get());

        $progress  = $this->progress ($certification, $itens);

        foreach ($consultant as $key => $value) {
            $value->percent_block = $progress;
            $value->save();

        }
    }

    public function getConsultant()
    {
        return $this->consultants = Consultant::all();
    }

    public function getProduct()
    {
        return $this->products = Product::all();
    }

    public function getBlock()
    {
        return $this->blocks = Block::all();
    }

    public function getIten()
    {
        return $this->itens = Iten::where('product_id', $this->product_id)
        ->where('block_id', $this->block_id)
        ->get();
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->default();
    }

    function progress ($atual, $total) {
        return ($atual / $total) * 100;
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
