<?php

namespace App\Support\OG;

use SimonHamp\TheOg\BorderPosition;
use SimonHamp\TheOg\Layout\AbstractLayout;
use SimonHamp\TheOg\Layout\Position;
use SimonHamp\TheOg\Layout\TextBox;

class BlogiLayout extends AbstractLayout
{
    protected BorderPosition $borderPosition = BorderPosition::All;
    protected int $borderWidth = 25;
    protected int $height = 630;
    protected int $padding = 40;
    protected int $width = 1200;

    public function features(): void
    {
        $this->addFeature((new TextBox())
            ->name('title')
            ->text($this->title())
            ->color($this->config->theme->getTitleColor())
            ->font($this->config->theme->getTitleFont())
            ->size(54)
            ->box(800, 400)
            ->position(
                x: 0,
                y: 0,
                relativeTo: function() {
                    if ($url = $this->getFeature('url')) {
                        return $url->anchor(Position::BottomLeft)
                            ->moveY(25);
                    }

                    return $this->mountArea()
                        ->anchor()
                        ->moveY(20);
                }
            )
        );

        if ($description = $this->description()) {
            $this->addFeature((new TextBox())
                ->name('description')
                ->text($description)
                ->color($this->config->theme->getDescriptionColor())
                ->font($this->config->theme->getDescriptionFont())
                ->size(28)
                ->box(1000, 240)
                ->position(
                    x: 0,
                    y: 50,
                    relativeTo: fn() => $this->getFeature('title')->anchor(Position::BottomLeft),
                )
            );
        }

        if ($url = $this->url()) {
            $this->addFeature((new TextBox())
                ->name('url')
                ->text($url)
                ->color($this->config->theme->getUrlColor())
                ->font($this->config->theme->getUrlFont())
                ->size(28)
                ->box($this->mountArea()->box->width(), 45)
                ->position(
                    x: 0,
                    y: 20,
                    relativeTo: fn() => $this->mountArea()->anchor(),
                )
            );
        }
    }

    // XXX: This feels weird... maybe it should happen in the theme? Or let the content decide?
    public function url(): string
    {
        if ($url = parent::url()) {
            return strtoupper($url);
        }

        return '';
    }
}
