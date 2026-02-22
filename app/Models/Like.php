<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PostTemoignage;


class Like extends Model
{
    protected $fillable = ['user_id', 'temoignage_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function temoignage(): BelongsTo
    {
        return $this->belongsTo(PostTemoignage::class);
    }
}
