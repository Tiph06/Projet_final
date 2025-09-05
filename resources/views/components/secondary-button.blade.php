@props(['type' => 'button'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
        'inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2 text-pink-700 font-medium
        border border-pink-200 bg-white/70 hover:bg-pink-50
        focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2 transition'
    ]) }}>
    {{ $slot }}
</button>