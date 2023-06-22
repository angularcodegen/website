<?php

namespace CG\Templates\PostTerms;

class PostTermsTemplate
{

    public function __construct()
    {
        add_action('get_footer', array($this, 'register_styles'));
    }

    public function render(): void
    {
        require 'PostTermsTemplate.phtml';
    }

    public function register_styles(): void
    {
        wp_enqueue_style(
            self::class,
            get_theme_file_uri('src/Templates/PostTerms/' . 'PostTermsTemplate' . '.css')
        );
    }

}