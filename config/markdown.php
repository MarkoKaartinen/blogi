<?php

return [
    'code_highlighting' => [
        /*
         * To highlight code, we'll use Shiki under the hood. Make sure it's installed.
         *
         * More info: https://spatie.be/docs/laravel-markdown/v1/installation-setup
         */
        'enabled' => false,

        /*
         * The name of or path to a Shiki theme
         *
         * More info: https://github.com/shikijs/shiki/blob/main/docs/themes.md
         */
        'theme' => 'nord',
    ],

    /*
     * When enabled, anchor links will be added to all titles
     */
    'add_anchors_to_headings' => true,

    /**
     * When enabled, anchors will be rendered as links.
     */
    'render_anchors_as_links' => false,

    /*
     * These options will be passed to the league/commonmark package which is
     * used under the hood to render markdown.
     *
     * More info: https://spatie.be/docs/laravel-markdown/v1/using-the-blade-component/passing-options-to-commonmark
     */
    'commonmark_options' => [
        'default_attributes' => [
            \League\CommonMark\Extension\CommonMark\Node\Inline\Image::class => [
                'class' => 'content-image'
            ]
        ],
        'allow_unsafe_links' => false,
        'max_nesting_level' => 10,
        'external_link' => [
            'internal_hosts' => [
                config('app.host_domain'),
                '/(^|\.)blogi\.test$/',
            ],
            'open_in_new_window' => true,
            'html_class' => 'external-link',
            'nofollow' => '',
            'noopener' => 'external',
            'noreferrer' => 'external',
        ]
    ],

    /*
     * Rendering markdown to HTML can be resource intensive. By default
     * we'll cache the results.
     *
     * You can specify the name of a cache store here. When set to `null`
     * the default cache store will be used. If you do not want to use
     * caching set this value to `false`.
     */
    'cache_store' => false,


    /*
     * When cache_store is enabled, this value will be used to determine
     * how long the cache will be valid. If you set this to `null` the
     * cache will never expire.
     *
     */
    'cache_duration' => null,

    /*
     * This class will convert markdown to HTML
     *
     * You can change this to a class of your own to greatly
     * customize the rendering process
     *
     * More info: https://spatie.be/docs/laravel-markdown/v1/advanced-usage/customizing-the-rendering-process
     */
    'renderer_class' => Spatie\LaravelMarkdown\MarkdownRenderer::class,

    /*
     * These extensions should be added to the markdown environment. A valid
     * extension implements League\CommonMark\Extension\ExtensionInterface
     *
     * More info: https://commonmark.thephpleague.com/2.4/extensions/overview/
     */
    'extensions' => [
        \League\CommonMark\Extension\Autolink\AutolinkExtension::class,
        \League\CommonMark\Extension\Strikethrough\StrikethroughExtension::class,
        \League\CommonMark\Extension\Table\TableExtension::class,
        \League\CommonMark\Extension\TaskList\TaskListExtension::class,
        \League\CommonMark\Extension\Footnote\FootnoteExtension::class,
        \League\CommonMark\Extension\Attributes\AttributesExtension::class,
        \League\CommonMark\Extension\DescriptionList\DescriptionListExtension::class,
        \Wnx\CommonmarkMarkExtension\MarkExtension::class,
        \League\CommonMark\Extension\ExternalLink\ExternalLinkExtension::class,
        \League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension::class,
        \App\Support\MarkdownImageExtension::class,
    ],

    /*
     * These block renderers should be added to the markdown environment. A valid
     * renderer implements League\CommonMark\Renderer\NodeRendererInterface;
     *
     * More info: https://commonmark.thephpleague.com/2.4/customization/rendering/
     */
    'block_renderers' => [
        // ['class' => FencedCode::class, 'renderer' => MyCustomCodeRenderer::class, 'priority' => 0]
    ],

    /*
     * These inline renderers should be added to the markdown environment. A valid
     * renderer implements League\CommonMark\Renderer\NodeRendererInterface;
     *
     * More info: https://commonmark.thephpleague.com/2.4/customization/rendering/
     */
    'inline_renderers' => [
        // ['class' => FencedCode::class, 'renderer' => MyCustomCodeRenderer::class, 'priority' => 0]
    ],

    /*
     * These inline parsers should be added to the markdown environment. A valid
     * parser implements League\CommonMark\Renderer\InlineParserInterface;
     *
     * More info: https://commonmark.thephpleague.com/2.4/customization/inline-parsing/
     */
    'inline_parsers' => [
        // ['parser' => MyCustomInlineParser::class, 'priority' => 0]
    ],
];
