<?php

namespace CG\Gutenberg;

class GlobalCssGutenberg
{

    public function __construct()
    {
        add_action('enqueue_block_editor_assets', array($this, 'add_gutenberg_css'));
    }

    public function add_gutenberg_css(): void
    {
        wp_enqueue_style('cdg-global-css', get_theme_file_uri('/src/Gutenberg/GlobalCssGutenberg.css'));
    }

}