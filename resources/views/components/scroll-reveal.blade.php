<?php $subtitle = "Bienvenue sur Info-Endo 💛" ?>
<section class="text-center py-16 px-4 bg-pink-50">
    <h1
        class="text-3xl md:text-4xl font-bold uppercase tracking-wide text-pink-800 mb-4 opacity-0 translate-y-10 scale-75 transition-all duration-1000 ease-out"
        data-animate-on-scroll>
        {{ $title = "hello"}}
    </h1>


    @if ($subtitle)
    <h2
        class="text-xl md:text-2xl text-pink-600 font-semibold mb-6 opacity-0 translate-y-10 transition-all duration-1000 delay-200 ease-out"
        data-animate-on-scroll>
        {{ $subtitle = "Bienvenue sur Info-Endo 💛" }}
    </h2>
    @endif

    <div
        class="prose prose-p:text-gray-800 prose-p:leading-relaxed max-w-3xl mx-auto opacity-0 translate-y-10 transition-all duration-1000 delay-400 ease-out"
        data-animate-on-scroll>
        @markdown
        {{ $slot }}
        @endmarkdown
    </div>

</section>