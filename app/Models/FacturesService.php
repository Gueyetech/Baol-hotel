<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturesService extends Model
{
    use HasFactory;
    protected $fillable = [
        'nbre'
    ];
}
