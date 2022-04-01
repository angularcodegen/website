<!DOCTYPE html>
<head>

    <!-- Global Metadata -->
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <title><?php wp_title('|', true, 'right'); ?><?= get_option('blogname'); ?></title>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/style.css'; ?>">
    <?php wp_head(); ?>

    <?php if (get_site_url() === 'https://codegen.studio' && is_user_logged_in() === false): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-R3P89JXDDQ"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'G-R3P89JXDDQ');
        </script>
    <?php endif; ?>

    <title>How To Implement Debounce And Throttle In JavaScript</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="<?= get_the_title() ?>">
    <meta name="description" content="<?= get_the_excerpt() ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url">
    <meta property="og:title" content="<?= get_the_title() ?>">
    <meta property="og:description" content="<?= get_the_excerpt() ?>">

    <!-- Twitter -->
    <meta property="twitter:url">
    <meta property="twitter:title" content="<?= get_the_title() ?>">
    <meta property="twitter:description" content="<?= get_the_excerpt() ?>">

</head>

<body <?php body_class(); ?>>

<nav class="container" style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <a href="<?php echo get_home_url() ?>" style="font-size: 2.5rem; color: #fff"><?= get_bloginfo('name') ?></a>
        <p style="margin: 0"><?= get_bloginfo('description') ?></p>
    </div>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'fallback_cb' => '__return_false',
        'container_id' => 'menu_gorne',
        'depth' => 0,
    ));
    ?>
</nav>


<style>
    #jumbo {
        padding-top: 120px;
        padding-bottom: 120px;
        position: relative;
    }

    #jumbo h1 {
        text-align: center;
    }
</style>

<div id="jumbo" class="container">
    <?php if (is_singular()): ?>
        <h1><?php the_title() ?></h1>
    <?php endif; ?>

    <?php if (is_search() || is_home()): ?>
        <?= get_search_form() ?>
    <?php endif; ?>
</div>
