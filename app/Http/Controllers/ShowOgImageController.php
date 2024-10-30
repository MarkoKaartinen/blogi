<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Support\MarkdownHandler;
use App\Support\OG\BlogiLayout;
use App\Support\OG\JetBrainsMono;
use Intervention\Image\Colors\Rgb\Color;
use SimonHamp\TheOg\BorderPosition;
use SimonHamp\TheOg\Image;
use SimonHamp\TheOg\Theme\Theme;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ShowOgImageController extends Controller
{
    public function article($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $theme = $this->theme();

        $borderColor = Color::create('#232730');

        $image = (new Image())
            ->theme($theme)
            ->layout(new BlogiLayout())
            ->title($article->title)
            ->url(config('app.url'))
            ->border(BorderPosition::All, $borderColor)
            ->description($article->seo_description)
            ->toString();

        return response($image)->header('Content-Type', 'image/png');
    }

    public function page($slug)
    {
        $file = MarkdownHandler::getPage($slug);
        $content = YamlFrontMatter::parse($file);

        $theme = $this->theme();

        $borderColor = Color::create('#232730');

        $image = (new Image())
            ->theme($theme)
            ->layout(new BlogiLayout())
            ->title($content->matter('title'))
            ->url(config('app.url'))
            ->border(BorderPosition::All, $borderColor)
            ->description($content->matter('description'))
            ->toString();

        return response($image)->header('Content-Type', 'image/png');
    }

    private function theme()
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
