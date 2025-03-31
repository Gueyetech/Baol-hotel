<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'nomComplet',
        'moi',
        'annee',
        'ccv',
        'montant',
        'facture_id'
    ];
}
