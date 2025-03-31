<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref',
        'montant',
        'path'
    ];

    public function reservation()
    {
        return $this->BelongsTo(Reservation::class, 'reservation_id');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'factures_services')
        ->withPivot('nbre')
        ->withTimestamps();
    }
    public function conversionDollar()
    {
        return $this->montant / 400;
    }
    public function created_at()
    {
        // Supposons que $reservation->date_depart est déjà une instance de Carbon ou une chaîne de date valide
        $created_at = Carbon::parse($this->created_at)->locale('fr_FR');
        $formattedDate = $created_at->isoFormat('LLL'); // 'LL' formatte la date au format "D MMMM YYYY" en français

        return $formattedDate;
    }
}
