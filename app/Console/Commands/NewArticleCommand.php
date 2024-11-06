<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\text;

class NewArticleCommand extends Command
{
    protected $signature = 'blogi:new-article';

    protected $description = 'Command description';

    public function handle(): void
    {
        $year = text(label: 'Vuosi', default: now()->format('Y'));
        $title = text(label: 'Otsikko');
        $slug = text(label: 'Slug', default: str($title)->slug());

        $markdown = "---
title: $title
slug: $slug
status: draft
published_at:
description:
categories:
- Kategoria
tags:
- Avainsana
---
{: class=\"lead\"}";

        $filepath = "articles/$year/$slug.md";
        if(Storage::disk('content')->exists($filepath)){
            error('Tämän niminen tiedosto on jo olemassa! ('.$filepath.')');
            return;
        }

        Storage::disk('content')->put($filepath, $markdown);
        info('Uusi artikkeli luotu! ('.$filepath.')');
        info('Luonnos: '.route('draft', [$year, $slug]));
    }
}
