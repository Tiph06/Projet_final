{{-- Vérifie s'il y a des pages à afficher --}}

@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-8">
    <ul class="inline-flex items-center space-x-2 text-sm">

        {{-- « Bouton Précédent (disabled si on est à la première page) --}}

        @if ($paginator->onFirstPage())
        <li class="px-3 py-1 bg-gray-200 text-gray-500 rounded">«</li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 bg-pink-100 text-pink-600 rounded hover:bg-pink-200 transition">
                «
            </a>
        </li>
        @endif

        {{-- Boucle sur tous les liens de pages --}}

        @foreach ($elements as $element)

        {{-- Cas où l'élément est une chaîne (ex : "...") --}}

        @if (is_string($element))
        <li class="px-3 py-1 text-gray-400">{{ $element }}</li>
        @endif

        {{-- Cas où l'élément est un tableau (n° page => URL) --}}

        @if (is_array($element))
        @foreach ($element as $page => $url)


        {{-- Page actuelle => bouton actif stylisé --}}
        @if ($page == $paginator->currentPage())
        <li class="px-3 py-1 bg-pink-600 text-white rounded font-semibold">
            {{ $page }}
        </li>
        @else

        {{-- Autres pages --}}
        <li>
            <a href="{{ $url }}"
                class="px-3 py-1 bg-pink-100 text-pink-600 rounded hover:bg-pink-200 transition">
                {{ $page }}
            </a>
        </li>
        @endif

        @endforeach
        @endif

        @endforeach


        {{-- » Bouton Suivant (disabled si on est à la dernière page) --}}

        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}"
                class="px-3 py-1 bg-pink-100 text-pink-600 rounded hover:bg-pink-200 transition">
                »
            </a>
        </li>
        @else
        <li class="px-3 py-1 bg-gray-200 text-gray-500 rounded">»</li>
        @endif

    </ul>
</nav>
@endif