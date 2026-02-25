@props(['logo' => null])

<div {{ $attributes->merge([
    'class' => 'w-full max-w-md bg-white/90 backdrop-blur rounded-2xl shadow-lg ring-1 ring-pink-100 p-6 sm:p-8'
]) }}>
    @if ($logo)
    <div class="flex justify-center mb-4">
        {{ $logo }}
    </div>
    @endif

    {{ $slot }}
</div>