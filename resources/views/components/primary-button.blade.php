<button {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 bg-rose-200 border border-rose-300 text-rose-800 rounded-md text-sm hover:bg-rose-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-400 transition'
]) }}>
    {{ $slot }}
</button>