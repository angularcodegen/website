<?php

namespace CG\Integrations\GoogleAdSense;

class GoogleAdSense
{

    public function __construct()
    {
        add_action('wp_footer', array($this, 'add_google_ad_sense'));
    }

    public static function turn_on(): void
    {
        new self();
    }

    public function add_google_ad_sense(): void
    {
        if (get_site_url() === 'https://codegen.studio' && is_user_logged_in() === false): ?>
            <script src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2279132360925160" 
            async crossorigin="anonymous"></script>
        <?php endif;
    }
}