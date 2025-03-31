<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'genre',
        'ville',
        'pays'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
