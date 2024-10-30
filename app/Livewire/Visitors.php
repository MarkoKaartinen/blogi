<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Visitors extends Component
{
    public $visitors = 0;

    public function mount()
    {
        $token = config('services.plausible.key');
        $url = config('services.plausible.url').'/api/v2/query';

        $response = Http::withToken($token)
            ->post($url, [
                'site_id' => config('services.plausible.site_id'),
                'metrics' => ['visits'],
                'date_range' => 'all',
            ]);


        if($response->successful()){
            if(isset($response->object()->results[0]->metrics[0])){
                $this->visitors = $response->object()->results[0]->metrics[0];
            }
        }
    }

    public function render()
    {
        return view('livewire.visitors');
    }
}
