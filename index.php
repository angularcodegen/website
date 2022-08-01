<?php

use CG\Templates\PostTile\PostTileTemplate;

get_header(); ?>

    <div class="container">
        <?php if (have_posts()) : ?>
            <main style="display: flex; flex-direction: column; gap: 4rem">
                <?php
                while (have_posts()) :
                    the_post();
                    $post_tile = new PostTileTemplate();
                    $post_tile->render();
                endwhile;
                ?>
            </main>
            <?php
            $prev = get_previous_posts_link();
            $next = get_next_posts_link();
            $styles = $prev ? 'justify-content: space-between;' : 'justify-content: flex-end;';
            ?>
            <div style="display: flex; <?= $styles ?>">
                <?php
                echo $prev;
                echo $next;
                ?>
            </div>
        <?php else: ?>
            <p>
                <?= __('The given phrase', 'cg') ?>
                - <em style="font-weight: bold"><?= get_search_query(false) ?></em> -
                <?= __('has not been found.', 'cg') ?>
            </p>

            <p><?= __('Hints', 'cg') ?>:</p>

            <ul>
                <li><?= __('Check that all words are spelled correctly.', 'cg') ?>.</li>
                <li><?= __('Please try different keywords.', 'cg') ?>.</li>
                <li><?= __('Try using more general keywords.', 'cg') ?>.</li>
            </ul>

        <?php endif; ?>
    </div>

<?php
get_sidebar();
get_footer();