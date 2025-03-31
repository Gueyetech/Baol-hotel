<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equippement extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'ref',
        'reservable_id',
    ];
    public function reservable()
    {
        return $this->BelongsTo(Reservable::class, 'reservable_id');
    }
}
