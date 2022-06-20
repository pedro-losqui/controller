<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iten extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'block_id',
        'description'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
