<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;
use function Laravel\Prompts\text;

class NewRecipeCommand extends Command
{
    protected $signature = 'blogi:new-recipe';

    protected $description = 'Creates a new recipe markdown file';

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
image: /media/{$year}/
servings_amount:
servings_unit: annosta
post_to_mastodon: true
categories:
- Kategoria
tags:
- Avainsana
ingredients:
- amount: 400
  unit: g
  name: jauhot
# Sektioita voi lisätä näin:
# - section: Osan nimi
# - amount: 2
#   unit: dl
#   name: maito
---
";

        $filepath = "recipes/$year/$slug.md";
        if (Storage::disk('content')->exists($filepath)) {
            error('Tämän niminen tiedosto on jo olemassa! ('.$filepath.')');

            return;
        }

        Storage::disk('content')->put($filepath, $markdown);
        info('Uusi resepti luotu! ('.$filepath.')');
    }
}
