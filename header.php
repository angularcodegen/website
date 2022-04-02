<!DOCTYPE html>
<head <?= get_language_attributes() ?>>

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

</head>

<body <?php body_class(); ?>>

<style>
    .header-nav {
        display: flex;
        flex-flow: column;
    }

    .header-nav > :first-child {
        flex: 0 0 50%;
    }

    @media (min-width: 768px) {
        .header-nav {
            justify-content: space-between;
            align-items: center;
            flex-flow: row;
        }
    }

</style>

<nav class="container header-nav">
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
        text-align: center;
    }
</style>

<div id="jumbo" class="container">
    <?php if (is_singular()): ?>
        <h1><?php the_title() ?></h1>
    <?php endif; ?>

    <?php if (is_single()): ?>
        <p><?= get_the_excerpt() ?></p>
    <?php endif; ?>

    <?php if (is_search() || is_home()): ?>
        <?= get_search_form() ?>
    <?php endif; ?>
</div>
