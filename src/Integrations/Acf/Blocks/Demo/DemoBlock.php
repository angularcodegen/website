<?php

namespace CG\Integrations\Acf\Blocks\Demo;

use CG\Integrations\Acf\AcfIntegration;

class DemoBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'demo',
            'title' => __('Demo', 'cg'),
            'description' => __('Demo przygotowanej aplikacji', 'cg'),
            'render_template' => __DIR__ . '/DemoBlock.phtml',
            'enqueue_style' => AcfIntegration::get_block_css(__DIR__, 'DemoBlock.css'),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
        ));
    }
}