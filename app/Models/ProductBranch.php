<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBranch extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'branch_id',
        'quantity',
    ];
}
