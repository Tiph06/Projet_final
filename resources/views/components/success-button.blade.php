@props(['type' => 'submit'])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
        'inline-flex w-full justify-center items-center gap-2 rounded-xl px-4 py-3 text-white text-base font-semibold bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700
        focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 shadow-sm transition'
    ]) }}>
    {{ $slot }}
</button>