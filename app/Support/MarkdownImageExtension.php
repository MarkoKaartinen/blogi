<?php

namespace App\Support;

use App\Livewire\Home;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\CommonMark\Node\Block\HtmlBlock;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\Config\ConfigurationAwareInterface;
use League\Config\ConfigurationInterface;
use League\CommonMark\Util\RegexHelper;
use League\CommonMark\Node\Inline\Newline;
use League\CommonMark\Node\NodeIterator;
use League\CommonMark\Node\StringContainerInterface;

class MarkdownImageExtension implements ExtensionInterface, NodeRendererInterface, ConfigurationAwareInterface
{
    private ConfigurationInterface $config;

    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment->addRenderer(Image::class, $this, 100);
    }

    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        $useFigure = false;
        if (($title = $node->getTitle()) !== null) {
            $useFigure = true;
        }


        $img = new HtmlElement('img', $this->buildImageAttrs($node));

        $url = $node->getUrl().'?size=xl';

        $linkAttrs = [
            'href' => $url,
            'class' => 'link-with-image glightbox',
            'data-description' => $title ?? '',
        ];

        $link = new HtmlElement('a', $linkAttrs, $img);

        if($useFigure){
            $figcaption = new HtmlElement('figcaption', ['class' => 'figure-caption'], $title);
            return new HtmlElement('figure', ['class' => 'content-figure'], [$link, $figcaption]);
        }
        return $link;
    }

    private function buildImageAttrs($node)
    {
        $attrs = $node->data->get('attributes');

        $url = $node->getUrl();

        $forbidUnsafeLinks = ! $this->config->get('allow_unsafe_links');
        if ($forbidUnsafeLinks && RegexHelper::isLinkPotentiallyUnsafe($url)) {
            $attrs['src'] = '';
        } else {
            $attrs['src'] = $url;
        }

        $attrs['alt'] = $this->getAltText($node);

        $classes = 'link-image content-image';
        if (($title = $node->getTitle()) !== null) {
            $attrs['title'] = $title;
            $classes = 'link-image figure-image';
        }

        $attrs['loading'] = 'lazy';
        $attrs['class'] = $classes;
        return $attrs;
    }

    public function setConfiguration(ConfigurationInterface $configuration): void
    {
        $this->config = $configuration;
    }

    private function getAltText(Image $node): string
    {
        $altText = '';

        foreach ((new NodeIterator($node)) as $n) {
            if ($n instanceof StringContainerInterface) {
                $altText .= $n->getLiteral();
            } elseif ($n instanceof Newline) {
                $altText .= "\n";
            }
        }

        return $altText;
    }
}
