<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductComponent extends Component
{
    public $company_id, $product, $description;

    public $action, $edit;

    public $search;

    protected $rules = [
        'company_id' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->action = 0;
        $this->edit = 0;
    }

    public function render()
    {
       if (Auth::user()->type == '0') {
            return view('livewire.product.product-component', [
                'products' => Product::where('description', 'like', '%'. $this->search .'%')
                ->get()
            ]);
       } else {
            return view('livewire.product.product-component', [
                'products' => Product::where('description', 'like', '%'. $this->search .'%')
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
        $this->product = Product::find($id);

        $this->description = $this->product->description;

        $this->action = 1;
        $this->edit = 1;
    }

    public function save()
    {
        $this->company_id = Auth::user()->company->id;
        $this->firstUpp();

        Product::create($this->validate());

        session()->flash('success', 'Bloco criado com sucesso.');
        return redirect()->to('/product');
    }

    public function update()
    {
        $this->product->company_id = Auth::user()->company->id;
        $this->product->description = $this->firstUpp();
        $this->product->save();

        session()->flash('success', 'Bloco alterado com sucesso.');
        return redirect()->to('/product');
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
        $this->description = '';
    }
}
