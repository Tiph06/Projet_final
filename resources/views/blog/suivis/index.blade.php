@extends('layout')

@section('content')

<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4 text-fuchsia-600">Mes suivis quotidiens 🩷</h2>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if($suivis->isEmpty())
    <p class="text-gray-500">Aucun suivi enregistré pour le moment.</p>
    @else
    <div class="grid gap-4">
        @foreach($suivis as $suivi)
        <div class="bg-white shadow rounded p-4 border border-gray-200">
            <p class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($suivi->date)->translatedFormat('d F Y') }}</p>
            <p><strong>État :</strong> {{ $suivi->etat }}</p>
            <p><strong>Douleurs :</strong> {{ $suivi->douleurs ? 'Oui' : 'Non' }}</p>
            @if($suivi->douleurs)
            <p><strong>Localisation :</strong> {{ $suivi->localisation }}</p>
            <p><strong>Intensité :</strong> {{ $suivi->intensite }}/10</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection