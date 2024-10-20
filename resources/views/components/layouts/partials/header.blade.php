<div class="h-12"></div>
<div class="sticky top-0 w-full  bg-nord-0 ">
    <div class="container mx-auto flex items-center justify-between py-2">
        <div class="font-bold text-3xl">
            <a wire:navigate href="{{ route('home') }}" class="transition-colors duration-300 text-nord-9 aspect-square flex items-center justify-center border-2 border-nord-9 leading-none size-12 hover:text-nord-0 hover:bg-nord-9 rounded tracking-tighter">
                MK
            </a>
        </div>
        <div>
            <ul class="flex space-x-4">
                <li><a class="text-base hover:font-bold hover:text-nord-11 transition-colors duration-300" href="{{ route('home') }}" wire:navigate><span class="text-nord-11">/</span>blogi</a></li>
                <li><a class="text-base hover:font-bold hover:text-nord-11 transition-colors duration-300" href="{{ route('page', ['nyt']) }}" wire:navigate><span class="text-nord-11">/</span>nyt</a></li>
                <li><a class="text-base hover:font-bold hover:text-nord-11 transition-colors duration-300" href="{{ route('page', ['tietoa']) }}" wire:navigate><span class="text-nord-11">/</span>tietoa</a></li>
                <li><a class="text-base hover:font-bold hover:text-nord-11 transition-colors duration-300" href="{{ route('search') }}" wire:navigate><span class="text-nord-11">/</span>haku</a></li>
            </ul>
        </div>
    </div>
</div>
