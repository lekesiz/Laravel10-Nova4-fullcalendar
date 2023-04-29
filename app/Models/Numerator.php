<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numerator extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'prefix',
        'suffix',
        'date_format',
        'next_number',
    ];
}
