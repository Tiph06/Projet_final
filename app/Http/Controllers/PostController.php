<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    // 📰 Affiche la liste des articles
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('blog.articles.index', compact('posts'));
    }

    // ➕ Formulaire de création d'article
    public function create()
    {
        return view('blog.articles.create');
    }

    // 🌐 Récupération d'un article depuis Wikipédia
    public function fetchFromWikipedia(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);

        $title = $request->input('title');
        $response = Http::get("https://fr.wikipedia.org/api/rest_v1/page/summary/" . urlencode($title));

        if ($response->ok()) {
            $data = $response->json();

            Post::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['extract'],
            ]);

            return redirect()->route('posts.index')->with('success', 'Article Wikipédia ajouté !');
        }
        return redirect()->back()->with('error', 'Impossible de récupérer l’article.');
    }

    // 💾 Enregistrement d'un article
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['source'] = 'admin'; // facultatif mais utile si je mélanges avec des articles Wiki plus tard

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Article ajouté avec succès !');
    }

    // 🔍 Voir un article
    public function show(Post $post)
    {
        return view('blog.articles.show', compact('post'));
    }

    // ✏️ Modifier un article
    public function edit(Post $post)
    {
        return view('blog.articles.edit', compact('post'));
    }

    // ✅ Mise à jour
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Article modifié avec succès !');
    }

    // ❌ Suppression
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Article supprimé avec succès !');
    }
}
