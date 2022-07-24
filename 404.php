<?php get_header(); ?>

    <main class="container">

        <p>
            <?= __('The requested URL', 'cg') ?>
            <code><?= $_SERVER['REQUEST_URI'] ?></code>
            <?= __('was not found on this server..', 'cg') ?>
            <?= __('Try to use search to find what you need.', 'cg') ?>
        </p>

        <?= get_search_form() ?>

    </main>

<?php

get_sidebar();
get_footer();