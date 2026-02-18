<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Recipe;
use App\Support\MarkdownHandler;
use App\Support\OG\BlogiLayout;
use App\Support\OG\JetBrainsMono;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Colors\Rgb\Color;
use SimonHamp\TheOg\BorderPosition;
use SimonHamp\TheOg\Image;
use SimonHamp\TheOg\Theme\Background;
use SimonHamp\TheOg\Theme\BackgroundPlacement;
use SimonHamp\TheOg\Theme\Theme;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ShowOgImageController extends Controller
{
    public function article($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $cacheKey = "og_article_{$slug}_{$article->updated_at?->timestamp}";

        $bytes = Cache::remember($cacheKey, now()->addHours(6), function () use ($article) {
            $borderColor = Color::create('#232730');

            return (new Image)
                ->theme($this->theme())
                ->layout(new BlogiLayout)
                ->title($article->title)
                ->url(config('app.url'))
                ->border(BorderPosition::All, $borderColor)
                ->description($article->seo_description)
                ->toString();
        });

        return response($bytes)->header('Content-Type', 'image/png');
    }

    public function recipe($slug)
    {
        $recipe = Recipe::where('slug', $slug)->firstOrFail();

        $cacheKey = "og_recipe_{$slug}_{$recipe->updated_at?->timestamp}";

        $bytes = Cache::remember($cacheKey, now()->addHours(6), function () use ($recipe) {
            $theme = $this->theme();
            $borderColor = Color::create('#232730');

            $builder = (new Image)
                ->theme($theme)
                ->layout(new BlogiLayout)
                ->title($recipe->title)
                ->url(config('app.url'))
                ->border(BorderPosition::All, $borderColor)
                ->description($recipe->seo_description);

            if ($recipe->image) {
                $imageDiskPath = str($recipe->image)->replaceFirst('/media/', '')->toString();
                $sourcePath = Storage::disk('media')->path($imageDiskPath);

                if (file_exists($sourcePath)) {
                    $builder->background(new Background($sourcePath), 0.2, BackgroundPlacement::Cover);
                }
            }

            return $builder->toString();
        });

        return response($bytes)->header('Content-Type', 'image/png');
    }

    public function page($slug)
    {
        $file = MarkdownHandler::getPage($slug);
        if ($file === false) {
            $file = MarkdownHandler::getPage('koti');
        }
        $content = YamlFrontMatter::parse($file);

        $cacheKey = "og_page_{$slug}";

        $bytes = Cache::remember($cacheKey, now()->addHours(6), function () use ($content) {
            $borderColor = Color::create('#232730');

            return (new Image)
                ->theme($this->theme())
                ->layout(new BlogiLayout)
                ->title($content->matter('title'))
                ->url(config('app.url'))
                ->border(BorderPosition::All, $borderColor)
                ->description($content->matter('description'))
                ->toString();
        });

        return response($bytes)->header('Content-Type', 'image/png');
    }

    private function theme(): Theme
    {
        return new Theme(accentColor: '#81a1c1',
            baseFont: JetBrainsMono::regular(),
            baseColor: '#eceff4',
            backgroundColor: '#2e3440',
            callToActionBackgroundColor: '#2e3440',
            callToActionColor: '#81a1c1',
            descriptionColor: '#eceff4',
            descriptionFont: JetBrainsMono::light(),
            titleFont: JetBrainsMono::extrabold(),
            urlFont: JetBrainsMono::bold(),
        );
    }
}
