<x-layout>
    <div class="">
        <h1 class="font-extrabold text-5xl">Now I'm going to show you an example of an unordered list to make sure that looks good, too</h1>
        <div class="flex gap-4 mt-2">
            <div class="text-sm text-nord-8">TORSTAINA 17. LOKAKUUTA 2024 KELLO 14:42</div>
            <div class="flex"><a class="text-sm uppercase text-nord-13 transition-colors duration-300 hover:text-nord-12" href="#">Kategoria</a></div>
        </div>
    </div>

    <div class="textcontent">
        <p class="lead">Nulla cupidatat esse magna esse aliqua ex eiusmod tempor fugiat consequat minim et. Id irure nisi est ut in qui sit non cupidatat do occaecat aliqua. Reprehenderit laborum nulla labore commodo in in laborum culpa veniam ea adipisicing amet quis. Deserunt ullamco eiusmod quis dolore dolor laborum irure incididunt elit cillum dolor.</p>

        <p>Nulla cupidatat esse magna esse aliqua ex eiusmod tempor fugiat consequat minim et. Id irure nisi est ut in qui sit non cupidatat do occaecat aliqua. Reprehenderit laborum nulla labore commodo in in laborum culpa veniam ea adipisicing amet quis. Deserunt ullamco eiusmod quis dolore dolor laborum irure incididunt elit cillum dolor.</p>

        <p>Nulla cupidatat esse magna esse aliqua ex eiusmod tempor fugiat consequat minim et. Id irure nisi est ut in qui sit non cupidatat do occaecat aliqua. Reprehenderit laborum nulla labore commodo in in laborum culpa veniam ea adipisicing amet quis. Deserunt ullamco eiusmod quis dolore dolor laborum irure incididunt elit cillum dolor.</p>

        <p>Nulla cupidatat esse magna esse aliqua ex eiusmod tempor fugiat consequat minim et. Id irure nisi est ut in qui sit non cupidatat do occaecat aliqua. Reprehenderit laborum nulla labore commodo in in laborum culpa veniam ea adipisicing amet quis. Deserunt ullamco eiusmod quis dolore dolor laborum irure incididunt elit cillum dolor.</p>


        <p>Nulla cupidatat esse magna esse aliqua ex eiusmod tempor fugiat consequat minim et. Id irure nisi est ut in qui sit non cupidatat do occaecat aliqua. Reprehenderit laborum nulla labore commodo in in laborum culpa veniam ea adipisicing amet quis. Deserunt ullamco eiusmod quis dolore dolor laborum irure incididunt elit cillum dolor.</p>

    </div>
    <div class="pt-6">
        <div>
            @for($i = 0; $i < 6; $i++)
                <a class="bg-nord-13 text-nord-0 text-base font-bold rounded px-1.5 py-0.5 leading-none transition-colors duration-300 hover:bg-nord-12" href="#">#tagi</a>
            @endfor
        </div>
    </div>
</x-layout>
