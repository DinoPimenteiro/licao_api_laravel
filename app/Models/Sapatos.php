<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sapatos extends Model
{
        protected $fillable = [
        'marca',
        'modelo',
        'numeracao',
        'preco'
    ];
}
