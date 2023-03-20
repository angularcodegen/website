<?php

use CG\Gutenberg\Gutenberg;
use CG\Integrations\ThemeIntegrations;
use CG\Plugins\ContactForm\ContactForm;
use CG\Plugins\RepositoryUpdateWebHook\RepositoryUpdateWebHook;
use CG\Seo\Seo;
use CG\ThemeOptions;

require_once __DIR__ . '/vendor/autoload.php';

Seo::turn_on();
ContactForm::init();
Gutenberg::turn_on();
ThemeIntegrations::turn_on_all();
RepositoryUpdateWebHook::init();

// @todo move this somewhere else

add_action('all_admin_notices', 'check_required_plugins');

function check_required_plugins()
{
    $required_plugins = [
        [
            'name' => "ACF",
            'url' => 'https://www.advancedcustomfields.com/',
            'slugs' => ['advanced-custom-fields/acf.php', 'advanced-custom-fields-pro/acf.php']
        ]
    ];

    foreach ($required_plugins as $plugin) {
        $is_active = false;
        foreach ($plugin['slugs'] as $slug) {
            if (is_plugin_active($slug)) {
                $is_active = true;
                break;
            }
        }

        if (!$is_active) {
            show_missing_plugin_error($plugin['name'], $plugin['url']);
        }
    }
}

function show_missing_plugin_error($name, $url)
{
    ?>
    <div class="notice notice-error">
        <p>The <?= $name ?> plugin is required for this theme. Please <a href="<?= $url ?>">install it here</a>.</p>
    </div>
    <?php
}

add_image_size('post_tile', 320, 180, array('center', 'center'));

function get_thumbnail_id_from_tree(): int
{
    if (has_post_thumbnail()) {
        return get_post_thumbnail_id();
    }

    $terms = get_the_category();

    foreach ($terms as $term) {
        $field = get_field('44008F46AA4D4368B1634E38B19A873F', $term);
        if ($field !== false && $field !== null) {
            return $field['id'];
        }
    }

    $default = ThemeOptions::get_default_thumbnail();
    return $default['id'];
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

function redirect_to_full_url_if_needed(): void
{
    if (get_the_ID() === false || is_single() === false) {
        return;
    }

    $current_url = get_home_url() . $_SERVER['REQUEST_URI'];
    $full_url = get_permalink();

    if (str_contains($current_url, $full_url)) {
        return;
    }

    wp_redirect($full_url, 301);
}

add_action('wp', 'redirect_to_full_url_if_needed');
