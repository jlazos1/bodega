<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 
        'doc_number',
        'net_amount', 
        'iva', 
        'document_type_id',
        'provider_id',
        'branch_id'
    ];
}
