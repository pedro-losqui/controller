<?php

namespace App\Models;

use App\Models\Iten;
use App\Models\Block;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'block_id',
        'iten_id',
        'percent_block',
        'status_block',
        'percent_iten',
        'status_iten',
    ];

    public function consultant()
    {
        return $this->hasOne(consultant::class, 'id', 'consultant_id');
    }

    public function iten()
    {
        return $this->hasOne(Iten::class, 'id', 'iten_id');
    }
}
