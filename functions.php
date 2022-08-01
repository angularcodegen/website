<?php

use CG\Gutenberg\Gutenberg;
use CG\Integrations\ThemeIntegrations;
use CG\Plugins\ContactForm\ContactForm;
use CG\Seo\Seo;
use CG\ThemeOptions;

require_once __DIR__ . '/vendor/autoload.php';

Seo::turn_on();
ContactForm::init();
Gutenberg::turn_on();
ThemeIntegrations::turn_on_all();

// @todo move this somewhere else

add_image_size('post_tile', 192, 108, array('center', 'center'));

function get_thumbnail_url_from_tree($size = 'post_tile'): string
{
    if (has_post_thumbnail()) {
        return get_the_post_thumbnail_url(null, $size);
    }

    $terms = get_the_category();

    foreach ($terms as $term) {
        $field = get_field('44008F46AA4D4368B1634E38B19A873F', $term);
        if ($field !== false && $field !== null) {
            return $field['sizes'][$size] ?? $field['url'];
        }
    }

    $default = ThemeOptions::get_default_thumbnail();
    return $default['sizes'][$size] ?? $default['url'];
}

function mytheme_register_nav_menu(): void
{
    register_nav_menus(array(
        'main-menu' => __('Main menu', 'cg'),
    ));
}

add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);

add_theme_support('html5', array(
        'search-form',
        'comment-list',
        'comment-form',
        'gallery',
        'caption',
    )
);

add_theme_support('post-thumbnails');

function no_self_ping(&$links): void
{
    $home = get_option('home');
    foreach ($links as $l => $link) {
        if (str_contains($link, $home)) {
            unset($links[$l]);
        }
    }
}

add_action('pre_ping', 'no_self_ping');

function remove_wp_block_library_css(): void
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