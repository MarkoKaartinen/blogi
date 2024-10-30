<?php

namespace App\Support\OG;

use SimonHamp\TheOg\Interfaces\Font;

class JetBrainsMono implements Font
{
    protected function __construct(protected ?string $variant = 'Regular')
    {

    }

    public static function regular(): self
    {
        return new self('Regular');
    }

    public static function extrabold(): self
    {
        return new self('ExtraBold');
    }

    public static function bold(): self
    {
        return new self('Bold');
    }

    public static function light(): self
    {
        return new self('Light');
    }

    public function path(): string
    {
        return resource_path('fonts/jetbrains-mono/JetBrainsMono-'.$this->variant.'.ttf');
    }
}
