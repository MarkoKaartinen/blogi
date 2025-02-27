<?php

namespace App\Console\Commands;

use App\Models\Changelog;
use App\Support\MarkdownHandler;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ImportChangelogsCommand extends Command
{
    protected $signature = 'blogi:import-changelogs {year?} {month?}';

    protected $description = 'Imports changelogs to database.';

    public function handle(): void
    {
        $year = $this->argument('year');
        $month = $this->argument('month');
        if($year === null){
            $year = now()->format('Y');
        }
        if($month === null){
            $month = now()->format('m');
        }
        if($month < 10 && strlen($month) < 2){
            $month = "0".$month;
        }

        $files = MarkdownHandler::getChangelogs($year, $month);
        foreach ($files as $filepath){
            $pathinfo = pathinfo($filepath);
            $created = new Carbon($pathinfo['filename']);
            $changelog = Changelog::updateOrCreate([
                'file' => $filepath,
            ], [
                'created_at' => $created,
                'updated_at' => $created,
            ]);
        }

        Cache::flush();
    }
}
