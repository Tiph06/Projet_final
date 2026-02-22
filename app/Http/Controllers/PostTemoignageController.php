<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostTemoignage;
use Illuminate\Support\Facades\Auth;

class PostTemoignageController extends Controller
{
    public function index()
    {
        // Récupérer tous les témoignages paginés (ex : 6 par page)
        $temoignages = PostTemoignage::orderByDesc('created_at')->paginate(3);

        return view('blog.temoignages.temoignages', compact('temoignages'));
    }

    //  Formulaire de création
    public function create()
    {
        return view('blog.temoignages.create');
    }

    //  Enregistrement du témoignage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie' => 'required|string',
            'content' => 'required|string|min:10',
            'auteur' => 'nullable|string|max:30',
        ]);

        // Si l'utilisateur coche "anonyme", on ne garde pas l'auteur
        $auteur = $request->has('anonyme') ? null : $validated['auteur'];

        $post = new PostTemoignage();
        $post->categorie = $validated['categorie'];
        $post->content = $validated['content'];
        $post->auteur = $auteur;
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('temoignages.index')->with('success', 'Témoignage envoyé avec succès 💌');
    }

    //  Suppression d’un témoignage
    public function destroy($id)
    {
        $post = PostTemoignage::findOrFail($id);
        $post->delete();

        return redirect()->route('temoignages.index')->with('success', 'Témoignage supprimé 🗑️');
    }
}
