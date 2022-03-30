<?php

namespace CG\Integrations\Acf\Blocks\CodePreview;

use CG\Integrations\Acf\AcfIntegration;

class CodePreviewBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'code_preview',
            'title' => __('Code preview'),
            'description' => __('A custom testimonial block.'),
            'render_template' => __DIR__ . '/CodePreviewBlock.phtml',
            'enqueue_style' => AcfIntegration::get_block_css(__DIR__, 'CodePreviewBlock.css'),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
        ));
    }
}

