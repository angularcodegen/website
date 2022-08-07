<?php

use CG\Templates\SingleIntro\SingleIntroTemplate;

get_header(); ?>

    <main class="container">

        <?php if (have_posts()) : while (have_posts()) :the_post(); ?>

            <?php
            if (is_single()) {
                $postIntro = new SingleIntroTemplate();
                $postIntro->render();
            }
            ?>

            <article>
                <?php the_content(); ?>
            </article>
        <?php endwhile;
            the_posts_navigation();
        endif; ?>
    </main>

<?php

if (comments_open() || get_comments_number()) :
    comments_template();
endif;

get_sidebar();
get_footer();