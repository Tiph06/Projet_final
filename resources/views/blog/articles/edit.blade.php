@extends('layout')

@section('content')
<h1>Modifier l’article</h1>

<form method="POST" action="{{ route('blog.update', $post->id) }}">
    @csrf
    @method('PUT')

    <label for="title">Titre</label>
    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" required>

    <label for="content">Contenu</label>
    <textarea id="content" name="content" required>{{ old('content', $post->content) }}</textarea>

    <button type="submit">Mettre à jour</button>
</form>
@endsection