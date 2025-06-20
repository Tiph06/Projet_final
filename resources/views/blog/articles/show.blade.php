@extends('layouts.layout')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-3xl font-bold text-pink-700 mb-4">{{ $post->title }}</h1>
    <div class="text-gray-800 leading-relaxed">
        {!! nl2br(e($post->content)) !!}
    </div>

    <div class="mt-6">
        <a href="{{ route('blog.article') }}" class="text-pink-500 hover:underline">← Retour à la liste</a>
    </div>
</div>
@endsection