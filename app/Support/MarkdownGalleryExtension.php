<?php

namespace App\Support;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Inline\Newline;

/**
 * Turns a paragraph that contains only two or more images into a gallery.
 */
class MarkdownGalleryExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addEventListener(DocumentParsedEvent::class, $this->markGalleries(...));
    }

    public function markGalleries(DocumentParsedEvent $event): void
    {
        foreach ($event->getDocument()->iterator() as $node) {
            if (! $node instanceof Paragraph) {
                continue;
            }

            $imageCount = $this->countImagesInImageOnlyParagraph($node);

            if ($imageCount < 2) {
                continue;
            }

            $node->data->append('attributes/class', 'gallery-grid');
            if ($imageCount >= 5) {
                $node->data->append('attributes/class', 'gallery-multi');
                $node->data->append('attributes/class', 'gallery-rem-'.($imageCount % 3));
            }
            $node->data->append('attributes/class', $imageCount % 2 === 0 ? 'gallery-even' : 'gallery-odd');
        }
    }

    private function countImagesInImageOnlyParagraph(Paragraph $paragraph): int
    {
        $imageCount = 0;

        foreach ($paragraph->children() as $child) {
            if ($child instanceof Image) {
                $imageCount++;
            } elseif (! $child instanceof Newline) {
                return 0;
            }
        }

        return $imageCount;
    }
}
