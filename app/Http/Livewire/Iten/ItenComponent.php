<?php

namespace App\Http\Livewire\Iten;

use App\Models\Iten;
use App\Models\Block;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ItenComponent extends Component
{
    public $company_id, $iten, $block_id, $blocks, $product_id, $product, $description;

    public $action, $edit;

    public $search;

    protected $rules = [
        'company_id' => 'required',
        'block_id' => 'required',
        'product_id' => 'required',
        'description' => 'required',
    ];

    protected $validationAttributes = [
        'product_id' => 'produto',
        'block_id' => 'bloco',
    ];

    public function mount()
    {
        $this->getProduct();
        $this->getBlock();
        $this->action = 0;
        $this->edit = 0;
    }

    public function render()
    {
        if (Auth::user()->type == '0') {
            return view('livewire.iten.iten-component', [
                'itens' => Iten::where('description', 'like', '%'. $this->search .'%')
                ->get()
            ]);
        } else {
            return view('livewire.iten.iten-component', [
                'itens' => Iten::where('description', 'like', '%'. $this->search .'%')
                ->where('company_id', Auth::user()->company->id)
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
        $this->iten = Iten::find($id);

        $this->product_id = $this->iten->product_id;
        $this->block_id = $this->iten->block_id;
        $this->description = $this->iten->description;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        $this->company_id = Auth::user()->company->id;
        $this->firstUpp();

        Iten::create($this->validate());

        session()->flash('success', 'Iten criado com sucesso.');
        return redirect()->to('/iten');
    }

    public function update()
    {
        $this->iten->company_id = Auth::user()->company->id;
        $this->iten->description = $this->firstUpp();
        $this->iten->product_id = $this->product_id;
        $this->iten->block_id = $this->block_id;
        $this->iten->save();

        session()->flash('success', 'Iten alterado com sucesso.');
        return redirect()->to('/iten');
    }

    public function getProduct()
    {
        return $this->products = Product::all();
    }

    public function getBlock()
    {
        return $this->blocks = Block::all();
    }

    public function firstUpp()
    {
        return $this->description = ucwords(mb_strtolower($this->description, 'UTF-8'));
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->default();
    }

    public function default()
    {
        $this->company_id = '';
        $this->product_id = '';
        $this->block_id = '';
        $this->iten = '';
        $this->description = '';
    }
}
