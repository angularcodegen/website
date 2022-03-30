<?php

use CG\Integrations\Acf\AcfIntegration;
use CG\Walkers\CustomWalkerComment;

require_once __DIR__ . '/vendor/autoload.php';

AcfIntegration::turn_on();

function mytheme_register_nav_menu()
{
    register_nav_menus(array(
        'main-menu' => __('Main menu', 'cg'),
    ));
}

add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);

add_theme_support('html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption'));


function no_self_ping(&$links)
{
    $home = get_option('home');
    foreach ($links as $l => $link) {
        if (str_contains($link, $home)) {
            unset($links[$l]);
        }
    }
}

add_action('pre_ping', 'no_self_ping');