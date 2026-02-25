@extends('layout')

@section('title', 'Nouvel Article – Info-Endo')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-pink-700 mb-6">📝 Ajouter un nouvel article Info-Endo</h2>

    @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('blog.articles.store') }}">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-semibold text-gray-700">Titre</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200">
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700">Contenu</label>
            <textarea name="content" id="content" rows="8" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-200">{{ old('content') }}</textarea>
        </div>

        <button type="submit"
            class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
            💾 Publier l'article
        </button>
    </form>
</div>
@endsection