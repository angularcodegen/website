<?php

namespace CG\Templates\SingleIntro;

class SingleIntroTemplate
{

    public function __construct()
    {
        add_action('get_footer', array($this, 'register_styles'));
    }

    public function render(): void
    {
        require 'SingleIntroTemplate.phtml';
    }

    public function register_styles(): void
    {
        wp_enqueue_style(
            self::class,
            get_theme_file_uri('src/Templates/SingleIntro/' . 'SingleIntroTemplate' . '.css')
        );
    }

}