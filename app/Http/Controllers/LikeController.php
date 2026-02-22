<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostTemoignage;
use Illuminate\Http\RedirectResponse;


class LikeController extends Controller
{
    public function toggle(Request $request, PostTemoignage $temoignage): RedirectResponse
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->back()->with('error', 'Vous devez être connecté pour liker un témoignage.');
        }

        $existingLike = $user->likes()->where('temoignage_id', $temoignage->id)->first();

        if ($existingLike) {
            // Si le like existe, le supprimer (unlike)
            $existingLike->delete();
            return redirect()->back()->with('success', 'Vous avez retiré votre like.');
        } else {
            // Sinon, créer un nouveau like
            $user->likes()->create(['temoignage_id' => $temoignage->id]);
            return redirect()->back()->with('success', 'Vous avez liké ce témoignage.');
        }
    }
}
