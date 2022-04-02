<?php

use CG\ContactForm\ContactForm;
use CG\Integrations\Acf\AcfIntegration;
use CG\Seo\Seo;

require_once __DIR__ . '/vendor/autoload.php';

AcfIntegration::turn_on();
Seo::turn_on();
ContactForm::init();

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

function remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('global-styles'); // REMOVE THEME.JSON
}

add_action('wp_enqueue_scripts', 'remove_wp_block_library_css', 100);

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');