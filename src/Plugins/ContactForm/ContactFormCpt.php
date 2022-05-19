<?php

namespace CG\Plugins\ContactForm;

class ContactFormCpt
{
    public const POST_TYPE = 'contactform';


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
                    'name' => __('Formularz'),
                    'singular_name' => __('Formularz')
                ),
                'has_archive' => true,
                'public' => false,
                'show_ui' => true,
                'publicly_queryable' => false,
                'exclude_from_search' => true,
                'show_in_rest' => false,
            )
        );
    }
}