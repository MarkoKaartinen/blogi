<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        <div class="pb-6 mt-6 textcontent">@markdown($markdown)</div>

        <div class="h-1 w-20 rounded-full bg-nord-9 mb-6 md:mb-12"></div>

        <div class=" mt-6 textcontent">
            <p>
                <strong>Kahvin ja veden suhde</strong><br />
                <span class="text-nord-11 font-bold">{{ $ratioCoffee }}</span> osa kahvia ja <span class="text-nord-11 font-bold">{{ $ratioWater }}</span> osaa vettä.
            </p>
            <p>
                <strong>Kahvin ja veden määrä per annos</strong><br />
                <span class="text-nord-11 font-bold">{{ $perServingCoffee }}</span> grammaa kahvia ja <span class="text-nord-11 font-bold">{{ $perServingWater }}</span> grammaa vettä.
            </p>
        </div>

        <div class="mb-6">
            <label for="cups" class="block font-bold text-base text-nord-7 mb-2">Montako kuppia?</label>
            <div class="flex flex-wrap gap-2">
                @for($i = 1; $i <= 10; $i++)
                    <button type="button" wire:click="setCup({{ $i }})" class="inline-flex items-center justify-center text-center {{ $cups == $i ? 'bg-nord-14 text-nord-0' : '' }} font-bold uppercase size-8 leading-none border-2 border-nord-14 rounded hover:bg-nord-14/80 hover:text-nord-0 transition-colors duration-300 text-base">
                        {{ $i }}
                    </button>
                @endfor
            </div>
        </div>

        <div class="pb-6 mt-6 textcontent">
            <p>
                <strong>Kahvin ja veden määrä</strong><br />
                <span class="text-nord-11 font-bold">{{ $coffee }}</span> grammaa kahvia ja <span class="text-nord-11 font-bold">{{ $water }}</span> grammaa vettä.
            </p>
            
            <p class="text-sm text-nord-12">
                Kahvilaskuri on tällä hetkellä kovakoodattuna itse käyttämilläni kahvin ja veden suhteilla. Tähän tulee jossain välissä muutos, jossa niitä voi säätää.
            </p>
        </div>

    </div>
</div>
