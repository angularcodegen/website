<?php

namespace CG\Gutenberg;


class HeaderIdAttribute
{

    public function __construct()
    {
        add_filter('render_block_core/heading', array($this, 'add_id_attribute_to_heading_block'));
    }

    public function add_id_attribute_to_heading_block($block_content): string
    {
        return preg_replace_callback(
            "#<(h[1-6])(.*?)>(.*?)<\/(h[1-6])>#",
            array($this, 'add_id_attribute_to_heading_block_callback'),
            $block_content
        );
    }

    public function add_id_attribute_to_heading_block_callback($match): string
    {
        [$full, $el_start, $attributes, $content, $el_end] = $match;

        if (str_contains($full, ' id="')) {
            return $full;
        }
        $id = sanitize_title_with_dashes($content);
        return "<{$el_start} id=\"{$id}\" {$attributes}>{$content}</{$el_end}>";
    }
}