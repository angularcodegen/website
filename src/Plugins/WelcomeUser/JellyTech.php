<?php

namespace CG\Plugins\WelcomeUser;

class JellyTech
{
    public function __construct()
    {
        add_action('init', array($this, 'show_welcome_init'));
    }

    public function show_welcome_init(): void
    {
        $ref = $_GET['WELCOME'] ?? '';

        if ($ref === 'JellyTech') {
            add_action('wp_footer', array($this, 'add_content'));
        }
    }

    public function add_content(): void
    {
        ?>
        <style data-js="welcome">
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
                display: flex;
                justify-content: center;
                flex-direction: column;
                gap: 1rem;
                align-items: center;

                margin: 1rem;

                background-color: #000000;
                padding: 20px;
                border: 1px solid #888;
                max-width: 500px;

                text-align: justify;
            }

            .modal-content > .message {
                width: 100%;
            }

            .modal-content > button {
                background-image: linear-gradient(144deg, #AF40FF, #5B42F3 50%, #00DDEB);
                border: 0;
                box-shadow: rgba(151, 65, 252, 0.2) 0 15px 30px -5px;
                color: #FFFFFF;
                font-size: 20px;

                padding: 16px 24px;
                border-radius: 6px;
                width: 100%;
                height: 100%;
                transition: 300ms;
            }

            .modal-content > button:focus, .modal-content > button:hover {
                transform: scale(1.05);
            }

        </style>
        <div id="welcomeModal" data-js="welcome" class="modal">
            <div class="modal-content">
                <img src="https://jellytech.com.pl/wp-content/uploads/2022/03/logo_www_nobg_72h.png"
                     alt="jellytech logo">
                <div class="message">
                    <h2>Witaj, JellyTech!</h2>
                    <p>
                        Właśnie znajdujesz się na blogu, który zacząłem prowadzić parę miesięcy temu.
                        Umieszczam tutaj artykuły, w których przedstawiam swój punkt widzenia na problemy,
                        z którymi napotkałem się w trakcie developmentu.
                        Mam nadzieję, że to co tutaj zobaczysz przypadie Ci do gustu!

                        <span style="display: block; margin-top: 1rem; text-align: right;">
                            Pozdrawiam<br>
                            Adrian
                        </span>
                    </p>

                </div>
                <button autofocus type="button">Zaczynajmy!</button>
            </div>
        </div>

        <script data-js="welcome">
            function removeWelcomeModal() {
                document.querySelectorAll('[data-js="welcome"]').forEach(el => el.remove());
            }

            const modal = document.querySelector('#welcomeModal');
            modal.querySelector('button').onclick = removeWelcomeModal;
        </script>
        <?php
    }
}