<?php

namespace CG\Seo;

class DescriptionSeo
{
    public function __construct()
    {
        add_action('wp_head', array($this, 'add_description'));
    }

    public function add_description(): void
    {
        $excerpt = '';
        if (is_category()) {
            $excerpt = category_description();
        } else if (is_singular()) {
            $excerpt = get_the_excerpt();
        }
        ob_start(); ?>

        <meta name="description" content="<?= $excerpt ?>">

        <?php echo ob_get_clean();
    }
}