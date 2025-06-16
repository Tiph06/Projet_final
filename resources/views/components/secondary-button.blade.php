<button {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 border border-pink-400 text-pink-700 bg-white rounded-md text-sm hover:bg-pink-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-300 transition'
]) }}>
    {{ $slot }}
</button>