<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bin extends Model
{
    use HasFactory;

    protected $table = 'bins';

    protected $fillable = [
        'item',
        'user',
        'status',
        'count'
    ];
}
