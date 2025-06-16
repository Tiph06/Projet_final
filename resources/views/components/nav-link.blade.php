@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 border-b-2 border-pink-500 text-sm font-medium leading-5 text-pink-600 focus:outline-none focus:border-pink-700 transition'
: 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-pink-500 hover:border-pink-400 focus:outline-none focus:text-pink-700 focus:border-pink-700 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>