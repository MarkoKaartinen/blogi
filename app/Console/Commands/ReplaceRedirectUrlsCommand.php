<?php

namespace App\Console\Commands;

use App\Models\Redirect;
use Illuminate\Console\Command;

class ReplaceRedirectUrlsCommand extends Command
{
    protected $signature = 'blogi:replace-redirect-urls';

    protected $description = 'Command description';

    public function handle(): void
    {
        $redirects = Redirect::get();
        foreach ($redirects as $redirect){
            $url = $redirect->new;
            $redirect->new = str($url)->replace('http://blogi.test', 'https://markokaartinen.net');
            $redirect->save();
        }
    }
}
