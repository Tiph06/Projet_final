<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;


class PostTemoignage extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie',
        'content',
        'auteur',
        'user_id',
    ];

    // recupérer les likes associés à un témoignage
    public function likes()
    {
        return $this->hasMany(Like::class, 'temoignage_id');
    }

    // compter le nombre de likes pour un témoignage
    public function likesCount()
    {
        return $this->likes()->count();
    }
}
