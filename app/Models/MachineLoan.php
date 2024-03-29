<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id',
        'loan_id',
    ];
}
