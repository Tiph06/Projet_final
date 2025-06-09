<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostTemoignage;
use Illuminate\Support\Facades\Auth;

class PostTemoignageController extends Controller
{
    // ➕ Formulaire de création
    public function create()
    {
        return view('blog.temoignages.create');
    }

    // 💾 Enregistrement du témoignage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie' => 'required|string',
            'content' => 'required|string|min:10',
        ]);

        $post = new PostTemoignage();
        $post->categorie = $validated['categorie'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('temoignages.index')->with('success', 'Témoignage envoyé avec succès 💌');
    }

    // ❌ Suppression d’un témoignage
    public function destroy($id)
    {
        $post = PostTemoignage::findOrFail($id);
        $post->delete();

        return redirect()->route('temoignages.index')->with('success', 'Témoignage supprimé 🗑️');
    }
}
