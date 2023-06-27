<?php

namespace CG\Templates\PostTile;

class PostTileTemplate
{

    public function __construct()
    {
        add_action('get_footer', array($this, 'register_styles'));
    }

    public function get_excerpt(): string
    {
        return get_the_excerpt();
    }

    public function render(): void
    {
        require 'PostTileTemplate.phtml';
    }

    public function register_styles(): void
    {
        wp_enqueue_style(
            self::class,
            get_theme_file_uri('src/Templates/PostTile/' . 'PostTileTemplate' . '.css')
        );
    }

}