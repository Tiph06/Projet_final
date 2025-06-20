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
        return view('blog.articles.article', compact('posts'));
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

            return redirect()->route('blog.posts.index')->with('success', 'Article Wikipédia ajouté !');
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


        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $i = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'slug' => $slug,
        ]);

        return redirect()->route('blog.posts.index')->with('success', 'Article ajouté avec succès !');
    }

    // 🔍 Voir un article
    public function show($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
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

        return redirect()->route('blog.posts.index')->with('success', 'Article modifié avec succès !');
    }

    // ❌ Suppression
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('blog.posts.index')->with('success', 'Article supprimé avec succès !');
    }
}
