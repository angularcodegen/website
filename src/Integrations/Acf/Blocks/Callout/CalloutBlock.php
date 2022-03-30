<?php

namespace CG\Integrations\Acf\Blocks\Callout;

use CG\Integrations\Acf\AcfIntegration;

class CalloutBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    function register_block()
    {
        acf_register_block_type(array(
            'name' => 'callout',
            'title' => __('Callout'),
            'description' => __('A custom testimonial block.'),
            'render_template' => __DIR__ . '/CalloutBlock.phtml',
            'enqueue_style' => AcfIntegration::get_block_css(__DIR__, 'CalloutBlock.css'),
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