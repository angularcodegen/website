<?php

use CG\Templates\PostTile\PostTileTemplate;

get_header(); ?>

    <main class="container" style="display: flex; flex-direction: column; gap: 4rem">
        <?php
        while (have_posts()) :
            the_post();
            $post_tile = new PostTileTemplate();
            $post_tile->render();
        endwhile;

        $prev = get_previous_posts_link();
        $next = get_next_posts_link();
        $styles = $prev ? 'justify-content: space-between;' : 'justify-content: flex-end;';
        ?>
        <div style="display: flex; <?= $styles ?>">
            <?= $prev ?>
            <?= $next ?>
        </div>
    </main>

<?php
get_sidebar();
get_footer();