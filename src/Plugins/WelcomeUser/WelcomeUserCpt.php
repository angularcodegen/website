<?php

namespace CG\Plugins\WelcomeUser;

use WP_Post;

class WelcomeUserCpt
{
    public const POST_TYPE = 'welcomeuser';

    public function __construct()
    {
        add_action('init', array($this, 'create_post_type'));

    }

    public function create_post_type(): void
    {

        register_post_type(
            self::POST_TYPE,
            array(
                'labels' => array(
                    'name' => __('Welcome user'),
                    'singular_name' => __('Welcome user')
                ),
                'has_archive' => true,
                'public' => false,
                'show_ui' => true,
                'publicly_queryable' => false,
                'exclude_from_search' => true,
                'show_in_rest' => true,
                'menu_icon'   => 'dashicons-welcome-learn-more',
                'supports' => array('editor', 'thumbnail', 'title')
            )
        );

        add_post_type_support( 'product', 'thumbnail' );
    }

    public static function find_by_title(string $title): WP_Post | null {
        return get_page_by_title($title, OBJECT, self::POST_TYPE);
    }
}
