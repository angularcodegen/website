<?php get_header(); ?>

    <main class="container">

        <p>
            <?= __('Podany adres URL', 'cg') ?>
            <code><?= $_SERVER['REQUEST_URI'] ?></code>
            <?= __('nie został znaleziony.', 'cg') ?>
            <?= __('Może skorzystaj z wyszukiwarki?', 'cg') ?>
        </p>

        <?= get_search_form() ?>

    </main>

<?php

get_sidebar();
get_footer();