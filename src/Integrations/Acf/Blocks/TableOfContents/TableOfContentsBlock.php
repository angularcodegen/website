<?php

namespace CG\Integrations\Acf\Blocks\TableOfContents;

use CG\Integrations\Acf\AcfIntegration;

class TableOfContentsBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'tableofcontents',
            'title' => __('Spis treści', 'cg'),
            'description' => __('A custom testimonial block.'),
            'render_template' => AcfIntegration::get_template_path_by_class_name(self::class),
            'enqueue_style' => AcfIntegration::get_style_uri_by_class_name(self::class),
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