<?php

namespace CG\Plugins\WelcomeUser;

use WP_Post;

class WelcomeUserPopup
{
    public function __construct()
    {
        add_action('init', array($this, 'show_welcome_init'));
    }

    public function show_welcome_init(): void
    {
        $ref = $_GET['WELCOME'] ?? '';

        if ($ref === '') {
            return;
        }

        $post = WelcomeUserCpt::find_by_title($ref);

        if ($post === null) {
            return;
        }

        $this->show_popup($post);
    }

    public function show_popup(WP_Post $post): void
    {
        add_action('wp_footer', array($this, 'css'));
        add_action('wp_footer', function () use ($post) {
            $this->html($post);
        }, 1);
        add_action('wp_footer', array($this, 'js'));

    }

    public function html(WP_Post $post): void
    {
        ?>
        <div id="welcomeModal" data-js="welcome" class="modal">
            <div class="modal-content">
                <?= get_the_post_thumbnail($post) ?>
                <h2>Witaj, <?= $post->post_title ?></h2>
                <?= do_blocks($post->post_content) ?>
                <button autofocus type="button">Zaczynajmy!</button>
            </div>
        </div>
        <?php
    }

    public function js(): void
    {
        ?>
        <script data-js="welcome">
            function removeWelcomeModal() {
                document.querySelectorAll('[data-js="welcome"]').forEach(el => el.remove());
            }

            const modal = document.querySelector('#welcomeModal');
            modal.querySelector('button').onclick = removeWelcomeModal;
        </script>
        <?php
    }

    public function css(): void
    {
        ?>
        <style>

            body {
                overflow: hidden;
            }

            .modal {
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);

                display: grid;
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                margin: 1rem;

                background-color: #000000;
                padding: 20px;
                border: 1px solid #888;
                max-width: 500px;

                text-align: justify;
            }

            .modal-content > img {
                display: block;
                max-width: 220px;
                margin: auto auto 2rem;
            }

            .modal-content > button {
                background-image: linear-gradient(144deg, #AF40FF, #5B42F3 50%, #00DDEB);
                border: 0;
                box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
                color: #FFFFFF;
                font-size: 20px;

                margin-top: 1.3rem;
                padding: 16px 24px;
                border-radius: 6px;
                width: 100%;
                transition: transform 300ms;
            }

            .modal-content > button:focus, .modal-content > button:hover {
                transform: scale(1.05);
            }
        </style>
        <?php
    }
}