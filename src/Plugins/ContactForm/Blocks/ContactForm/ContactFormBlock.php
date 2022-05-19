<?php

namespace CG\Plugins\ContactForm\Blocks\ContactForm;

use CG\Integrations\Acf\AcfIntegration;

class ContactFormBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'contactform',
            'title' => __('Contactform'),
            'description' => __('Brak'),
            'render_template' => AcfIntegration::get_template_path_by_class_name(self::class),
            'enqueue_style' => AcfIntegration::get_style_uri_by_class_name(self::class),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
        ));
    }
}