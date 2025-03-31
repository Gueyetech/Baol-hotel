<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function reservable()
    {
        return $this->belongsTo(Reservable::class, 'reservable_id');
    }

}
