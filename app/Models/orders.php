<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'delivery',
        'payment',
        'user',
        'address',
        'sum',
        'status',
        'comments'
    ];
}
