<?php

namespace App\Livewire;

use App\Support\MarkdownHandler;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ShowRecipeDraft extends Component
{
    public string $title = '';

    public string $body = '';

    public ?string $description = null;

    public ?string $image = null;

    public ?int $servingsAmount = null;

    public string $servingsUnit = 'annosta';

    public array $ingredients = [];

    public string $year;

    public string $slug;

    public function mount(string $year, string $slug): void
    {
        $file = MarkdownHandler::getRecipe($year, $slug);

        abort_if($file === false, 404);

        $content = YamlFrontMatter::parse($file);

        $this->year = $year;
        $this->slug = $slug;
        $this->title = $content->matter('title') ?? '';
        $this->description = $content->matter('description');
        $this->image = $content->matter('image');
        $this->servingsAmount = $content->matter('servings_amount');
        $this->servingsUnit = $content->matter('servings_unit') ?? '';
        $this->ingredients = $content->matter('ingredients') ?? [];
        $this->body = str($content->body())->trim();
    }

    public function render()
    {
        return view('livewire.show-recipe-draft');
    }
}
