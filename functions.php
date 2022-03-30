<?php

use CG\Integrations\Acf\AcfIntegration;

require_once __DIR__.'/vendor/autoload.php';

AcfIntegration::turn_on();


function mytheme_register_nav_menu()
{
    register_nav_menus(array(
        'main-menu' => __('Main menu', 'cg'),
    ));
}

add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);
