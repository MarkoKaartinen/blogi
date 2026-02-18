<div wire:key="recipe-draft-{{ $year }}-{{ $slug }}" class="px-6 md:px-0">
    <div class="text-nord-11 font-bold text-xl">LUONNOS</div>
    <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">{{ $title }}</h1>

    @if($image)
        <div class="mt-6">
            <img src="{{ $image }}" alt="{{ $title }}" class="rounded-xl border-2 border-nord-10 w-full object-cover max-h-96">
        </div>
    @endif

    @if($description)
        <div class="textcontent">
            <p class="lead">{{ $description }}</p>
        </div>
    @endif

    @if(count($ingredients) > 0)
        <div class="mt-8" x-data="{
            currentServings: {{ $servingsAmount ?? 1 }},
            baseServings: {{ $servingsAmount ?? 1 }},
            formatAmount(amount) {
                if (amount === null || amount === undefined || amount === '') return '';
                const str = String(amount);
                const num = str.includes('/')
                    ? parseFloat(str.split('/')[0]) / parseFloat(str.split('/')[1])
                    : parseFloat(str);
                const scaled = num * this.currentServings / this.baseServings;
                const whole = Math.floor(scaled);
                const frac = scaled - whole;
                if (frac < 0.01) return whole.toString();
                if (frac > 0.99) return (whole + 1).toString();
                const gcd = (a, b) => b === 0 ? a : gcd(b, a % b);
                let bestNum = 1, bestDen = 2, bestError = Infinity;
                for (let den = 2; den <= 8; den++) {
                    const n = Math.round(frac * den);
                    if (n === 0 || n === den) continue;
                    const error = Math.abs(frac - n / den);
                    if (error < bestError) { bestError = error; bestNum = n; bestDen = den; }
                }
                const g = gcd(bestNum, bestDen);
                const fracStr = `${bestNum / g}/${bestDen / g}`;
                return whole === 0 ? fracStr : `${whole} ${fracStr}`;
            }
        }">
            <div class="mb-4">
                <h2 class="text-2xl font-extrabold mb-4">Ainesosat</h2>

                @if($servingsAmount)
                    <div>
                        <div class="inline-flex items-center gap-2 text-sm bg-theme-0 rounded-lg px-3 py-1.5">
                            <button type="button" @click="currentServings = Math.max(1, currentServings - 1)" class="size-6 flex items-center justify-center rounded border border-nord-3 hover:bg-nord-2 transition-colors duration-150 font-bold">−</button>
                            <span class="font-bold min-w-[1.5rem] text-center" x-text="currentServings"></span>
                            <button type="button" @click="currentServings++" class="size-6 flex items-center justify-center rounded border border-nord-3 hover:bg-nord-2 transition-colors duration-150 font-bold">+</button>
                            @if($servingsUnit)
                                <span class="text-nord-8 uppercase text-xs">{{ str($servingsUnit)->ucfirst() }}</span>
                            @endif
                        </div>
                        <button x-show="currentServings !== baseServings" x-cloak @click="currentServings = baseServings" class="text-xs text-nord-8 hover:text-nord-4 transition-colors duration-150 ml-1">Nollaa</button>
                    </div>
                @endif
            </div>

            <ul class="space-y-1">
                @foreach($ingredients as $ingredient)
                    @if(isset($ingredient['section']))
                        <li class="font-bold text-nord-13 mt-4 first:mt-0">{{ $ingredient['section'] }}</li>
                    @else
                        <li class="flex gap-3">
                                            <span class="text-nord-8 min-w-[5rem] text-right shrink-0">
                                    @if(isset($ingredient['amount']))
                                        @if($servingsAmount)
                                            <span x-text="formatAmount('{{ $ingredient['amount'] }}')"></span>
                                        @else
                                            {{ $ingredient['amount'] }}
                                        @endif
                                    @endif
                                    {{ isset($ingredient['unit']) ? ' '.$ingredient['unit'] : '' }}
                                </span>
                            <span>{{ $ingredient['name'] ?? '' }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <div class="textcontent mt-8">
        @markdown($body)
    </div>
</div>
