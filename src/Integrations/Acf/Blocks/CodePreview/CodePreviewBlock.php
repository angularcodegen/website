<?php

namespace CG\Integrations\Acf\Blocks\CodePreview;

use CG\Integrations\Acf\AcfIntegration;
use WP_Block_Type_Registry;

class CodePreviewBlock {
    public const NAME = 'acf/code-preview';

    public function __construct() {
        add_action('acf/init', array($this, 'register_block'));
        add_filter('allowed_block_types_all', array($this, 'remove_code_block'));
        add_action('save_post', array($this, 'format_code_if_needed'));
    }

    public function register_block(): void {
        acf_register_block_type(
            array(
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
            )
        );
    }

    public function remove_code_block($allowed_blocks): array {
        $instance = WP_Block_Type_Registry::get_instance();
        $instance->unregister('core/code');
        return array_keys($instance->get_all_registered());
    }

    public function format_code_if_needed($post_id) {
        $post_content = get_the_content(null, false, $post_id);
        $has_block = has_block(self::NAME, $post_content);
        if(false === $has_block) {
            return;
        }

        $parsed = parse_blocks($post_content);
        foreach($parsed as &$block) {
            if($block['blockName'] === self::NAME) {
                $should_format = $block['attrs']['data']['585E222B4DA4043E42F80B2E676BB369'];

                if("1" === $should_format) {
                    $language = $block['attrs']['data']['593D265269114F70B5E116DB58AF9BE5'];
                    $code = $block['attrs']['data']['8E9300D01F9547E781F8F7DE5DCA0742'];
                    $formatted = CodePreviewHttp::format($language, $code);
                    $block['attrs']['data']['8E9300D01F9547E781F8F7DE5DCA0742'] = $formatted;
                }
            }
        }

        $new_post_content = serialize_blocks($parsed);

        remove_action('save_post', array($this, 'format_code_if_needed'));
        wp_update_post(array(
            'ID' => $post_id,
            'post_content' => wp_slash($new_post_content),
        ));
        add_action('save_post', array($this, 'format_code_if_needed'));
    }

}

