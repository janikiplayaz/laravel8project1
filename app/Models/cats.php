<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cats extends Model
{
    use HasFactory;

    protected $table  = 'cats';

    protected $filable = [
        'name'
    ];
}
