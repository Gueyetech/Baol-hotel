<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservable extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
        'etage',
        'capacite',
        'tarif',
        'etat',
        'description',
        'image',
    ];

    public function chambre()
    {
        return $this->hasOne(Chambre::class);
    }
    public function etat()
    {
        return $this->belongsTo(Etat::class, 'etat_id');
    }

    public function salle()
    {
        return $this->hasOne(Salle::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function equippements()
    {
        return $this->hasMany(Equippement::class , 'reservable_id');
    }
}
