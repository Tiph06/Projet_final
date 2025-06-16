<button {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 bg-rose-500 border border-rose-600 text-white rounded-md text-sm hover:bg-rose-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-400 transition'
]) }}>
    {{ $slot }}
</button>