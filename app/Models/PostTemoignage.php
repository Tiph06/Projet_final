<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTemoignage extends Model
{
    use HasFactory;

    protected $fillable = ['categorie', 'content', 'auteur'];
}
