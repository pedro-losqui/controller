<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bday',
        'pix',
        'cpf',
        'rg',
    ];

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Hour()
    {
        return $this->hasOne(Hour::class, 'id', 'consultant_id');
    }

}
