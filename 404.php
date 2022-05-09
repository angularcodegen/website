<?php get_header(); ?>

    <main class="container">

        <p>
            <?= __('Podany adres', 'cg') ?>
            <code><?= $_SERVER['REQUEST_URI'] ?></code>
            <?= __('nie został znaleziony.', 'cg') ?>
            <?= __('Skorzystaj z wyszukiwarki, aby znaleźć to czego szukasz.', 'cg') ?>
        </p>

        <?= get_search_form() ?>

    </main>

<?php

get_sidebar();
get_footer();