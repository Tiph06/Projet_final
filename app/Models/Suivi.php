<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suivi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'etat',
        'douleurs',
        'localisation',
        'intensite',
    ];

    // relation avec User (si tu veux l'utiliser)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
