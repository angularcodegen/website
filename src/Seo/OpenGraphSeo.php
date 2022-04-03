<?php

namespace CG\Seo;

class OpenGraphSeo
{
    public function __construct()
    {
        add_action('wp_head', array($this, 'add_title'));
    }

    public function add_title(): void
    {
        $title = '';
        $excerpt = '';

        if (is_category()) {
            $id = get_queried_object_id();
            $title = get_cat_name($id);
            $excerpt = category_description();
        } else if (is_singular()) {
            $title = get_the_title();
            $excerpt = wp_strip_all_tags(get_the_excerpt(), true);
        }

        ob_start(); ?>

        <?php if (is_singular()): ?>
        <meta property="og:type" content="article">
    <?php endif; ?>
        <?php if (is_home()): ?>
        <meta property="og:type" content="website">
    <?php endif; ?>


        <?php if (is_singular()): ?>
        <meta property="article:published_time" content="<?= get_the_date('c') ?>"/>
    <?php endif; ?>

        <?php if (is_singular()): ?>
        <meta property="article:modified_time" content="<?= get_the_modified_time('c') ?>"/>
    <?php endif; ?>

        <meta property="og:site_name" content="<?= get_option('blogname') ?>"/>
        <meta property="og:locale" content="<?= get_locale() ?>"/>
        <meta property="og:url" content="<?= get_permalink() ?>">
        <meta property="og:title" content="<?= $title ?>">
        <meta property="og:description" content="<?= $excerpt ?>">

        <?php echo ob_get_clean();
    }
}