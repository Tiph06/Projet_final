<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    //  Article statique (extrait Wikipédia)
    public function wikipedia()
    {
        $posts = Post::paginate(5); // ou paginate() si tu préfères
        return view('blog.articles.article', compact('posts'));
    }

    //  Article dynamique en base
    public function show($slug, $id)
    {
        $post = Post::findOrFail($id);

        $response = Http::get('https://api.unsplash.com/photos/random', [
            'query' => 'endometriosis',
            'client_id' => env('UNSPLASH_ACCESS_KEY'),
            'orientation' => 'landscape',
        ]);

        $image = $response->successful() ? $response['urls']['regular'] : null;

        return view('blog.articles.show', compact('post', 'image'));
    }
}
