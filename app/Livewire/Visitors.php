<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Throwable;

class Visitors extends Component
{
    public int $visitors = 0;

    public function mount(): void
    {
        $this->visitors = Cache::remember('plausible_visitors', 60, function (): int {
            $token = config('services.plausible.key');
            $url = config('services.plausible.url').'/api/v2/query';

            try {
                $response = Http::withToken($token)
                    ->timeout(5)
                    ->connectTimeout(5)
                    ->post($url, [
                        'site_id' => config('services.plausible.site_id'),
                        'metrics' => ['visits'],
                        'date_range' => 'all',
                    ]);
            } catch (Throwable $exception) {
                report($exception);

                return 0;
            }

            if ($response->successful()) {
                if (isset($response->object()->results[0]->metrics[0])) {
                    return $response->object()->results[0]->metrics[0];
                }
            }

            report("Plausible request failed with status [{$response->status()}] for [{$url}]");

            return 0;
        });
    }

    public function render()
    {
        return view('livewire.visitors');
    }
}
