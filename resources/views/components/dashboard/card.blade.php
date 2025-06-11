@props(['icon' => '📦', 'title' => 'Titre', 'value' => null])

<div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition duration-200">
    <div class="text-3xl">{{ $icon }}</div>
    <h3 class="text-lg font-semibold mt-2 text-gray-800">{{ $title }}</h3>
    <p class="text-2xl font-bold text-pink-600 mt-1">{{ $value ?? '...' }}</p>
</div>