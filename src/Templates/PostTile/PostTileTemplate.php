<?php

namespace CG\Templates\PostTile;

class PostTileTemplate
{

    public function __construct()
    {
        add_action('get_footer', array($this, 'register_styles'));
    }

    public function get_title(): string
    {
        $post_excerpt = get_the_excerpt();
        $no_tags = wp_strip_all_tags($post_excerpt);
        $cut = wp_trim_words($post_excerpt, 35, '...');
        return $no_tags === $cut ? '' : $no_tags;
    }

    public function get_excerpt(): string
    {
        return wp_trim_words(get_the_excerpt(), 35, '...');
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