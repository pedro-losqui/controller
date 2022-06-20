<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'consultant_id',
        'type_service',
        'customer',
        'value',
        'hours',
        'payment',
        'status',
    ];

    public function consultant()
    {
        return $this->hasOne(consultant::class, 'id', 'consultant_id');
    }

    public function user()
    {
        return $this->hasOne(Iten::class, 'id', 'user_id');
    }

}
