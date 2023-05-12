<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price'
    ];
}
