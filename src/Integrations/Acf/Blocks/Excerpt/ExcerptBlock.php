<?php

namespace CG\Integrations\Acf\Blocks\Excerpt;

use CG\Integrations\Acf\AcfIntegration;
use WP_Block_Editor_Context;
use WP_Block_Type_Registry;
use WP_Post;

class ExcerptBlock
{
    public const NAME = 'acf/excerpt';

    public function __construct()
    {
        add_filter('the_content', array($this, 'remove_excerpt_from_content'), 5);
        add_filter('get_the_excerpt', array($this, 'get_excerpt_from_content'), 10, 2);
        add_action('acf/init', array($this, 'register_block'));
        add_filter('allowed_block_types_all', array($this, 'remove_post_excerpt_block'), 10, 2);
    }

    public function register_block(): void
    {
        acf_register_block_type(array('name' => 'excerpt', 'title' => __('Zajawka', 'cg'), 'description' => __('Własna implementacja zajawki', 'cg'), 'render_template' => __DIR__ . '/ExcerptBlock.phtml', 'enqueue_style' => AcfIntegration::get_block_css(__DIR__, 'ExcerptBlock.css'), 'mode' => 'preview', 'category' => 'formatting', 'icon' => 'admin-comments', 'keywords' => array(), 'supports' => array('jsx' => true, 'multiple' => false,),));
    }

    public function remove_excerpt_from_content(string $content): string
    {
        if (self::has_block() === false) {
            return $content;
        }

        $parsed = parse_blocks($content);

        foreach ($parsed as $index => $block) {
            if ($block['blockName'] === self::NAME) {
                unset($parsed[$index]);
                break;
            }
        }

        return serialize_blocks($parsed);
    }

    public static function has_block(): bool
    {
        return has_block(self::NAME);
    }

    public function get_excerpt_from_content(string $default_excerpt, WP_Post $post): string
    {
        if (self::has_block() === false) {
            return $default_excerpt;
        }

        return self::get_excerpt();
    }

    public static function get_excerpt(): string|null
    {
        global $post;
        $blocks = parse_blocks($post->post_content);
        foreach ($blocks as $block) {
            if ($block['blockName'] === self::NAME) {
                return render_block($block);
            }
        }

        return null;
    }

    public function remove_post_excerpt_block($allowed_blocks, WP_Block_Editor_Context $post): array
    {
        if ($post->post->post_type === 'post') {
            $instance = WP_Block_Type_Registry::get_instance();
            $instance->unregister('core/post-excerpt');
            return array_keys($instance->get_all_registered());
        }

        return $allowed_blocks;
    }


}



