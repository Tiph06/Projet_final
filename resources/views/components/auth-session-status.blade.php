@props(['status'])

@if ($status)
<div {{ $attributes->merge([
        'class' => 'mb-4 font-medium text-sm text-pink-700 bg-pink-100 border border-pink-300 rounded-md px-4 py-3'
    ]) }}>
    {{ $status }}
</div>
@endif