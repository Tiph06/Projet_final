@props(['status'])

@if ($status)
<div {{ $attributes->merge([
        'class' => 'mb-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-2 text-sm'
    ]) }}>
    {{ $status }}
</div>
@endif