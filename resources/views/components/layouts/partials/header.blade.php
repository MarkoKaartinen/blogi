@php
$navItems = [
    ['name' => 'blogi', 'url' => route('blog'), 'navigate' => true],
    ['name' => 'vieraskirja', 'url' => route('guestbook'), 'navigate' => true],
    ['name' => 'linkit', 'url' => route('links'), 'navigate' => true],
    ['name' => 'reseptit', 'url' => route('recipes'), 'navigate' => true],
    ['name' => 'haku', 'url' => route('search'), 'navigate' => true],
];

if (auth()->check() && auth()->user()->is_admin) {
    $navItems[] = ['name' => 'admin', 'url' => route('filament.admin.pages.dashboard'), 'navigate' => false];
}

$secondaryNavItems = [
    ['name' => 'nyt', 'url' => route('page', ['nyt']), 'navigate' => true],
    ['name' => 'tietoa', 'url' => route('page', ['tietoa']), 'navigate' => true],
    ['name' => 'kahvilaskuri', 'url' => route('coffee-calc'), 'navigate' => true],
];
@endphp
<div class="h-6 md:h-12"></div>
<div class="sticky top-0 w-full  bg-nord-0 z-[100]">
    <div class="container mx-auto flex items-center justify-between py-2 px-6 lg:px-0">
        <div class="font-bold text-3xl">
            <a wire:navigate href="{{ route('home') }}" class="transition-colors duration-300 text-nord-9 aspect-square flex items-center justify-center border-2 border-nord-9 leading-none size-12 hover:text-nord-0 hover:bg-nord-9 rounded tracking-tighter">
                MK
            </a>
        </div>
        <div>
            <div class="hidden md:flex space-x-4 items-center">
                <ul class="flex space-x-4">
                    @foreach($navItems as $navItem)
                        <li><a class="text-base hover:font-bold hover:text-nord-11 transition-colors duration-300" href="{{ $navItem['url'] }}" {{ ($navItem['navigate'] ?? true) ? 'wire:navigate' : '' }}><span class="text-nord-11">/</span>{{ $navItem['name'] }}</a></li>
                    @endforeach
                </ul>
                <div class="hidden md:block relative" @click.outside="open = false" x-data="{ open: false }">
                    <div>
                        <button aria-label="Menu" x-on:click="open = !open" class="size-8 transition-all flex items-center justify-center border-nord-4 hover:bg-nord-4 hover:text-nord-0">
                            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="absolute right-0 z-10 mt-2 w-44 text-base origin-top-right divide-y rounded shadow-lg ring-1 ring-opacity-5 focus:outline-none bg-nord-2 ring-nord-0 divide-nord-0 text-nord-4 overflow-clip" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                         x-cloak
                         x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                    >
                        @foreach($secondaryNavItems as $navItem)
                            <a role="menuitem" class="block px-4 py-2 hover:bg-nord-1" href="{{ $navItem['url'] }}" {{ ($navItem['navigate'] ?? true) ? 'wire:navigate' : '' }}><span class="text-nord-11">/</span>{{ $navItem['name'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="block md:hidden relative" @click.outside="open = false" x-data="{ open: false }">
                <div>
                    <button aria-label="Menu" x-on:click="open = !open" class="size-10 border-2 stroke-2 rounded transition-all flex items-center justify-center border-nord-4 hover:bg-nord-4 hover:text-nord-0">
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="absolute right-0 z-10 mt-2 w-40 origin-top-right divide-y rounded shadow-lg ring-1 ring-opacity-5 focus:outline-none bg-nord-2 ring-nord-0 divide-nord-0 text-nord-4 overflow-clip" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                     x-cloak
                     x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                >
                    @foreach($navItems as $navItem)
                        <a role="menuitem" class="block px-4 py-2 hover:bg-nord-1" href="{{ $navItem['url'] }}" {{ ($navItem['navigate'] ?? true) ? 'wire:navigate' : '' }}><span class="text-nord-11">/</span>{{ $navItem['name'] }}</a>
                    @endforeach
                    @foreach($secondaryNavItems as $navItem)
                        <a role="menuitem" class="block px-4 py-2 hover:bg-nord-1" href="{{ $navItem['url'] }}" {{ ($navItem['navigate'] ?? true) ? 'wire:navigate' : '' }}><span class="text-nord-11">/</span>{{ $navItem['name'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
