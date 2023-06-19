<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsMachineRelocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'machine_id', 
        'machine_relocation_id'
    ];
}
