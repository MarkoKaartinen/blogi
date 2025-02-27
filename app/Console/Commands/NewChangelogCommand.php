<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;
use function Laravel\Prompts\info;

class NewChangelogCommand extends Command
{
    protected $signature = 'blogi:new-changelog';

    protected $description = 'Creates a new changelog markdown file.';

    public function handle(): void
    {
        $markdown = "";
        $year = now()->format('Y');
        $month = now()->format('m');
        $filename = now()->format('YmdHis');

        $filepath = "changelogs/$year/$month/$filename.md";
        if(Storage::disk('content')->exists($filepath)){
            error('Tämän niminen tiedosto on jo olemassa! ('.$filepath.')');
            return;
        }

        Storage::disk('content')->put($filepath, $markdown);
        info('Uusi muutosloki tiedosto luotu! ('.$filepath.')');
    }
}
