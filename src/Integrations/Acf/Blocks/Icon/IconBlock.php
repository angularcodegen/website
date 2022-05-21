<?php

namespace CG\Integrations\Acf\Blocks\Icon;

use CG\Integrations\Acf\AcfIntegration;

class IconBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'icon',
            'title' => __('Ikona'),
            'description' => __('A svg icon'),
            'render_template' => AcfIntegration::get_template_path_by_class_name(self::class),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
            'supports' => array(),
        ));
    }
}