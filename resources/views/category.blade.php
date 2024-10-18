<x-layout>
    <div class="text-left pb-12 max-w-2xl">
        <h1 class="font-extrabold text-5xl mb-4 text-nord-13">
            Kategorian nimi
        </h1>
        <p class="text-nord-13 text-base">Nulla cupidatat esse magna esse aliqua ex eiusmod tempor fugiat consequat minim et. Id irure nisi est ut in qui sit non cupidatat do occaecat aliqua. Reprehenderit laborum nulla labore commodo in in laborum culpa veniam ea adipisicing amet quis. Deserunt ullamco eiusmod quis dolore dolor laborum irure incididunt elit cillum dolor.</p>
    </div>
    <div class="grid grid-cols-1 gap-12 max-w-2xl">
        <div class="h-1 w-20 rounded-full bg-nord-9"></div>

        @for($i = 0; $i < 10; $i++)
            <div class="">
                <h2 class="text-2xl font-bold">
                    <a class="text-nord-11 hover:text-nord-12 transition-colors duration-300"  href="/artikkeli">
                        Lorem ipsum dolor sit amet
                    </a>
                </h2>
                <div class="flex items-center space-x-3 mt-1">
                    <div class="text-xs uppercase text-nord-8">Torstaina 17.10.2024 klo 17:47</div>

                    <div class="flex">
                        <a class="text-xs uppercase text-nord-13 transition-colors duration-300 hover:text-nord-12" href="/kategoria">Kategoria</a>
                    </div>
                </div>
                <div class="text-sm pt-2 line-clamp-3">Nulla cupidatat esse magna esse aliqua ex eiusmod tempor fugiat consequat minim et. Id irure nisi est ut in qui sit non cupidatat do occaecat aliqua. Reprehenderit laborum nulla labore commodo in in laborum culpa veniam ea adipisicing amet quis. Deserunt ullamco eiusmod quis dolore dolor laborum irure incididunt elit cillum dolor.</div>
                <div class="flex pt-1">
                    <a class="text-nord-11 text-sm hover:text-nord-12 transition-colors duration-300" href="/artikkeli">Lue lisää <i class="ri-arrow-right-double-fill"></i></a>
                </div>

                <div class="pt-2">
                    @for($j = 0; $j < 6; $j++)
                        <a class="bg-nord-13 text-nord-0 text-xs font-bold rounded px-1.5 py-0.5 leading-none transition-colors duration-300 hover:bg-nord-12" href="/tagi">#tagi</a>
                    @endfor
                </div>
            </div>

        @endfor
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <button class="text-sm uppercase border border-nord-4 font-bold block leading-none px-2 py-2 text-nord-4 rounded transition-colors duration-300 hover:bg-nord-6 hover:text-nord-0" type="button">
                    Edellinen
                </button>
            </div>

            <div class="leading-none text-lg font-bold">4 / 10</div>

            <div class="flex items-center">
                <button class="text-sm uppercase border border-nord-4 font-bold block leading-none px-2 py-2 text-nord-4 rounded transition-colors duration-300 hover:bg-nord-6 hover:text-nord-0" type="button">
                    Seuraava
                </button>
            </div>
        </div>
    </div>
</x-layout>
