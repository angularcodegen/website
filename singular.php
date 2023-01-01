<?php

use CG\Templates\Advertising\AdSense\AdSenseTemplate;
use CG\Templates\Donations\DonationsTemplate;
use CG\Templates\SingleIntro\SingleIntroTemplate;

get_header(); ?>

    <main class="container">
        <?php if (have_posts()):
            while (have_posts()):
                the_post();
                if (is_single()) :
                    $intro = new SingleIntroTemplate();
                    $intro->render();

                    $ad = new AdSenseTemplate();
                    $ad->render();
                endif;

                ?>
                <article id="article-content"><?php the_content(); ?></article>

                <?php
                if (is_single()):
                    $donations = new DonationsTemplate();
                    $donations->render();
                endif;
                ?>

            <?php endwhile; ?>
            <?php the_posts_navigation(); ?>
        <?php endif; ?>
    </main>

<?php

if (comments_open() || get_comments_number()) :
    comments_template();
endif;

get_sidebar();
get_footer();