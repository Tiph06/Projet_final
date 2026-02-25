@props(['type' => 'submit'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
        'inline-flex w-full justify-center items-center gap-2 rounded-xl px-4 py-3 text-white text-base font-semibold bg-gradient-to-r from-pink-300 to-fuchsia-500 hover:from-pink-400 hover:to-fuchsia-600
        focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2 shadow-sm transition'
    ]) }}>
    {{ $slot }}
</button>