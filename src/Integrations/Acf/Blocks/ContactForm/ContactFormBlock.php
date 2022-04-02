<?php

namespace CG\Integrations\Acf\Blocks\ContactForm;

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
            'render_template' => __DIR__ . '/ContactFormBlock.phtml',
            'enqueue_style' => AcfIntegration::get_block_css(__DIR__, 'ContactFormBlock.css'),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
        ));
    }
}