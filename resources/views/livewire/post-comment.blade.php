<div class="border-2 border-nord-12 rounded-2xl p-6 bg-theme-0">
    <h2 class="text-3xl font-extrabold mb-4">Kommentoi</h2>
    <p class="text-sm mb-4">Voit kommentoida artikkelia alla olevan lomakkeen avulla. Roskapostin välttämiseksi kysymme sähköpostin, mutta emme julkaise sitä. Tekstikenttä ottaa vastaan vain tekstiä ja kaikki muu siivotaan pois.</p>
    <form wire:submit="postComment">
        <x-honeypot livewire-model="extraFields" />
        <div class="grid grid-cols-1 gap-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label for="nickname" class="block text-sm uppercase">Nimimerkki</label>
                    <input wire:model="nickname" nickname class="w-full bg-transparent border-2 rounded mt-1 border-nord-12 py-2 px-2 focus:outline-none focus:border-nord-13 text-base" type="text" name="nickname" required />
                    <div class="text-xs text-nord-11 mt-1">@error('nickname') {{ $message }} @enderror</div>
                </div>
                <div>
                    <label for="email" class="block text-sm uppercase">Sähköposti</label>
                    <input wire:model="email" class="w-full bg-transparent border-2 rounded mt-1 border-nord-12 py-2 px-2 focus:outline-none focus:border-nord-13 text-base" type="email" name="email" />
                    <div class="text-xs text-nord-11 mt-1">@error('homepage') {{ $message }} @enderror</div>
                </div>
                <div>
                    <label for="homepage" class="block text-sm uppercase">Kotisivut</label>
                    <input wire:model="homepage" class="w-full bg-transparent border-2 rounded mt-1 border-nord-12 py-2 px-2 focus:outline-none focus:border-nord-13 text-base" type="url" name="homepage" />
                    <div class="text-xs text-nord-11 mt-1">@error('homepage') {{ $message }} @enderror</div>
                </div>
            </div>
            <div>
                <label for="message" class="block text-sm uppercase">Viesti</label>
                <textarea wire:model="message" id="message" class="w-full bg-transparent border-2 rounded mt-1 border-nord-12 py-2 px-2 focus:outline-none focus:border-nord-13 text-base" name="message" rows="6" required></textarea>
                <div class="text-xs text-nord-11">@error('message') {{ $message }} @enderror</div>
            </div>
            <div x-data="{}">
                <button type="submit" class="inline-block bg-nord-14 text-nord-0 font-bold uppercase px-3 py-3 leading-none border-2 border-nord-14 rounded hover:bg-transparent hover:text-nord-14 transition-colors duration-300 text-base" >Lähetä kommentti</button>
                <button type="button" x-on:click="$dispatch('hidecommentform')">Peruuta</button>
            </div>

            @if($feedback)
                <div class="text-nord-14">{{ $feedback }}</div>
            @endif
        </div>
    </form>
</div>
