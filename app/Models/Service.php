<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prix',
        'description'

    ];
    public function factures()
    {
        return $this->belongsToMany(Facture::class, 'factures_services')
        ->withPivot('nbre')
        ->withTimestamps();
    }
}
