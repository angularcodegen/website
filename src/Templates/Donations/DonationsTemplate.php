<?php

namespace CG\Templates\Donations;

class DonationsTemplate
{

    public function __construct()
    {
        add_action('get_footer', array($this, 'register_styles'));
    }


    public function render(): void
    {
        require 'DonationsTemplate.phtml';
    }

    public function register_styles(): void
    {
        wp_enqueue_style(
            self::class,
            get_theme_file_uri('src/Templates/Donations/' . 'DonationsTemplate' . '.css')
        );
    }

}