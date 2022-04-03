<?php

namespace CG\Seo;

class TitleSeo
{

    public function __construct()
    {
        add_action('wp_head', array($this, 'add_title'));
    }

    public function add_title(): void
    {
        $title = '';
        if (is_category()) {
            $id = get_queried_object_id();
            $title = get_cat_name($id);
        } else if (is_singular()) {
            $title = get_the_title();
        }
        ob_start(); ?>

        <meta name="title" content="<?= $title ?>">

        <?php echo ob_get_clean();
    }
}