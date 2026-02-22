<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Suivi;
use App\Models\Like;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // relation avec Suivi
    public function suivis()
    {
        return $this->hasMany(Suivi::class);
    }

    // relation avec Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function hasLiked($temoignageId) //vérifie si l'utilisateur a déjà liké un témoignage
    {
        return $this->likes()->where('temoignage_id', $temoignageId)->exists();
    }
}
