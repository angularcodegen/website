<?php

namespace CG\Integrations\Acf;

class AcfThemeOptions
{


    public function __construct()
    {
        add_action('acf/init', array($this, 'my_acf_op_init'));

    }

    function my_acf_op_init()
    {
        acf_add_options_page(array(
            'page_title' => __('Theme General Settings'),
            'menu_title' => __('Szablon'),
            'menu_slug' => 'theme-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        ));
    }
}