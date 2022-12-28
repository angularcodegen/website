<?php

namespace CG\Integrations\Acf\Blocks\CodePreview;

use CG\Integrations\Acf\AcfIntegration;
use WP_Block_Type_Registry;

class CodePreviewBlock
{
    public function __construct()
    {
        add_action('acf/init', array($this, 'register_block'));
        add_filter('allowed_block_types_all', array($this, 'remove_code_block'));
    }

    public function register_block(): void
    {
        acf_register_block_type(array(
            'name' => 'code_preview',
            'title' => __('Code preview', 'cg'),
            'description' => __('A custom testimonial block.', 'cg'),
            'render_template' => AcfIntegration::get_template_path_by_class_name(self::class),
            'enqueue_style' => AcfIntegration::get_style_uri_by_class_name(self::class),
            'enqueue_script' => AcfIntegration::get_script_uri_by_class_name(self::class),
            'mode' => 'preview',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => array(),
        ));
    }

    public function remove_code_block($allowed_blocks): array
    {
        $instance = WP_Block_Type_Registry::get_instance();
        $instance->unregister('core/code');
        return array_keys($instance->get_all_registered());
    }
}

