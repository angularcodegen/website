<?php

namespace CG\Seo;

class Seo
{


    public function __construct()
    {
        add_action('wp_head', array($this, 'add_meta_properties'));
    }

    public static function turn_on(): void
    {
        new self();
    }

    public function add_meta_properties(): void
    {
        $excerpt = '';
        $title = '';

        if (is_category()) {
            $id = get_queried_object_id();
            $title = get_cat_name($id);
            $excerpt = category_description();
        } else if (is_singular()) {
            $title = get_the_title();
            $excerpt = get_the_excerpt();
        }

        $title = wp_strip_all_tags($title, true);
        $excerpt = wp_strip_all_tags($excerpt, true);

        ob_start(); ?>

        <?php if ($title !== ''): ?>
        <meta name="title" content="<?= $title ?>">
        <meta property="og:title" content="<?= $title ?>">
    <?php endif; ?>

        <?php if ($excerpt !== ''): ?>
        <meta name="description" content="<?= $excerpt ?>">
        <meta property="og:description" content="<?= $excerpt ?>">
    <?php endif; ?>


        <?php if (is_singular()): ?>
        <meta property="og:type" content="article">
    <?php endif; ?>
        <?php if (is_home()): ?>
        <meta property="og:type" content="website">
    <?php endif; ?>


        <?php if (is_singular()): ?>
        <meta property="article:published_time" content="<?= get_the_date('c') ?>"/>
        <meta property="article:modified_time" content="<?= get_the_modified_time('c') ?>"/>
    <?php endif; ?>

        <?php
        $id = get_thumbnail_id_from_tree();
        $metadata = wp_get_attachment_metadata($id);
        ?>
        <?php if (is_single()): ?>
        <meta property="og:image" content="<?= wp_get_attachment_url($id) ?>"/>
        <meta property="og:image:width" content="<?= $metadata["width"] ?>"/>
        <meta property="og:image:height" content="<?= $metadata["height"] ?>"/>
        <meta property="og:image:type" content="<?= $metadata["sizes"]["thumbnail"]["mime-type"] ?>"/>
    <?php endif; ?>

        <meta property="og:site_name" content="<?= get_option('blogname') ?>"/>
        <meta property="og:locale" content="<?= get_locale() ?>"/>
        <meta property="og:url" content="<?= get_permalink() ?>">

        <?php echo ob_get_clean();
    }

}