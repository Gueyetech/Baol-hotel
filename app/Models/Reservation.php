<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'date_arrivee',
        'date_depart',
        'nombre',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function reservable()
    {
        return $this->belongsTo(reservable::class, 'reservable_id');
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    public function getTotal()
    {
        $totalFactures = $this->factures->sum('montant');
        return $totalFactures;
    }
    public function getIntervalle()
    {
        $dateArrivee = Carbon::parse($this->date_arrivee);
        $dateDepart = Carbon::parse($this->date_depart);
        $nombreDeJours = $dateDepart->diffInDays($dateArrivee) + 1;

        return $nombreDeJours;
    }
    public function date_depart()
    {
        // Supposons que $reservation->date_depart est déjà une instance de Carbon ou une chaîne de date valide
        $date_depart = Carbon::parse($this->date_depart)->locale('fr_FR');
        $formattedDate = $date_depart->isoFormat('LL'); // 'LL' formatte la date au format "D MMMM YYYY" en français

        return $formattedDate;
    }
    public function date_arrivee()
    {
        // Supposons que $reservation->date_depart est déjà une instance de Carbon ou une chaîne de date valide
        $date_arrivee = Carbon::parse($this->date_arrivee)->locale('fr_FR');
        $formattedDate = $date_arrivee->isoFormat('LL'); // 'LL' formatte la date au format "D MMMM YYYY" en français

        return $formattedDate;
    }



}
