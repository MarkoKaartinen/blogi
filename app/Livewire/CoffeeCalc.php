<?php

namespace App\Livewire;

use App\Support\MarkdownHandler;
use App\Support\SEO;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class CoffeeCalc extends Component
{
    public string $title;
    public string $markdown;

    public int $cups = 4;

    public int $ratioCoffee = 1;
    public int $ratioWater = 15;

    public int $perServingCoffee = 16;
    public int $perServingWater = 240;

    public int $coffee;
    public int $water;

    public function render()
    {
        return view('livewire.coffee-calc');
    }

    public function count()
    {
        $this->coffee = ($this->cups * $this->perServingWater) / $this->ratioWater;
        $this->water = $this->coffee * $this->ratioWater;
    }

    public function setCup($cups)
    {
        $this->cups = $cups;
        $this->count();
    }

    public function mount()
    {
        $this->count();

        $file = MarkdownHandler::getFile('pages/kahvilaskuri.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', ['kahvilaskuri']),
            url: route('coffee-calc'),
            titleSuffix: true
        );
    }
}
