<?php

namespace CG\Integrations\Acf\Blocks\Alert;

use CG\Integrations\Acf\AcfIntegration;

class AlertBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'alert',
            'title' => __('Alert'),
            'description' => __('A custom testimonial block.'),
            'render_template' => __DIR__ . '/AlertBlock.phtml',
            'enqueue_style' => AcfIntegration::get_block_css(__DIR__, 'AlertBlock.css'),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
            'supports' => array(
                'jsx' => true
            ),
        ));
    }
}