<?php

namespace CG\Integrations\Acf\Blocks\Link;

use CG\Integrations\Acf\AcfIntegration;

class LinkBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'link',
            'title' => __('Link do strony'),
            'description' => __('Bez opisu'),
            'render_template' => AcfIntegration::get_template_path_by_class_name(self::class),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
            'supports' => array(),
        ));
    }
}