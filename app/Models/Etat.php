<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];
    public function reservable()
    {
        return $this->hasOne(Reservable::class, 'etat_id');
    }
}
