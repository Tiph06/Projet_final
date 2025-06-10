<button {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-700 rounded-md text-sm text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition'
]) }}>
    {{ $slot }}
</button>