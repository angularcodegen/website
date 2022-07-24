<?php

get_header(); ?>

    <main class="container" style="display: flex; flex-direction: column; gap: 4rem">
        <?php
        while (have_posts()) :the_post(); ?>

            <article id="<?php the_ID(); ?>" <?php post_class() ?>>

                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg>

                    <?php echo get_the_date(); ?>
                </span>

                <h4 style="font-size: 1.5rem; margin: 0">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>


                <?php the_excerpt(); ?>

                <p>
                    <a href="<?php the_permalink(); ?>"><?= __('Read more', 'cg') ?></a>
                </p>
            </article>

        <?php endwhile; ?>
        <?php
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