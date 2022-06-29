<?php

namespace App\Http\Livewire\Block;

use App\Models\Block;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BlockComponent extends Component
{
    public $company_id, $products, $block, $description;

    public $action, $edit;

    public $search;

    protected $rules = [
        'company_id' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->getProducts();
        $this->action = 0;
        $this->edit = 0;
    }

    public function render()
    {
        if (Auth::user()->type == '0') {
            return view('livewire.block.block-component', [
                'blocks' => Block::where('description', 'like', '%'. $this->search .'%')
                ->get()
            ]);
        } else {
            return view('livewire.block.block-component', [
                'blocks' => Block::where('description', 'like', '%'. $this->search .'%')
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
        $this->block = Block::find($id);

        $this->description = $this->block->description;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        $this->company_id = Auth::user()->company->id;
        $this->firstUpp();

        Block::create($this->validate());

        session()->flash('success', 'Bloco criado com sucesso.');
        return redirect()->to('/block');
    }

    public function update()
    {
        $this->block->company_id = Auth::user()->company->id;
        $this->block->description = $this->firstUpp();
        $this->block->save();

        session()->flash('success', 'Bloco alterado com sucesso.');
        return redirect()->to('/block');
    }

    public function firstUpp()
    {
        return $this->description = ucwords(mb_strtolower($this->description, 'UTF-8'));
    }

    public function getProducts()
    {
        return $this->products = Product::all();
    }

    public function cancel()
    {
        $this->resetValidation();
        $this->default();
    }

    public function default()
    {
        $this->company_id = '';
        $this->block = '';
        $this->description = '';
    }
}
