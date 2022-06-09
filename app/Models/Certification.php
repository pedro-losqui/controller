<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
