@props([
'disabled' => false,
'type' => 'text',
])

<input
    {{ $disabled ? 'disabled' : '' }}
    type="{{ $type }}"
    {!! $attributes->merge([
'class' =>
'block w-full rounded-xl border border-gray-200 bg-white/90 placeholder-gray-400
focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500
transition px-3 py-2'
]) !!}
>