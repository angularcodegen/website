<?php

namespace CG\Integrations\GoogleTagManager;

class GoogleTagManagerIntegration
{

    public function __construct()
    {
        add_action('wp_footer', array($this, 'add_google_tag_manager'));
    }

    public static function turn_on(): void
    {
        new self();
    }

    public function add_google_tag_manager(): void
    {
        if (get_site_url() === 'https://codegen.studio' && is_user_logged_in() === false): ?>
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-R3P89JXDDQ"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', 'G-R3P89JXDDQ');
            </script>
        <?php endif;
    }
}