<?php

namespace CG\Plugins\ContactForm;

use CG\ThemeOptions;

class AjaxContactForm
{
    public const SEND_FORM_ACTION = 'sendcontactform';


    public function __construct()
    {
        $action = self::SEND_FORM_ACTION;
        add_action("wp_ajax_nopriv_{$action}", array($this, 'handle_action'));
        add_action("wp_ajax_{$action}", array($this, 'handle_action'));
    }

    public function handle_action(): void
    {
        $digit_1 = (int)$_REQUEST['digit_first'];
        $digit_2 = (int)$_REQUEST['digit_second'];
        $sum = (int)$_REQUEST['recaptcha'];

        if ($digit_1 === 0 || $digit_2 === 0 || ($digit_1 + $digit_2) !== $sum) {
            wp_die('recaptcha failed');
        }

        $subject = $_REQUEST['subject'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $content = $_REQUEST['content'];

        if (empty($subject) || empty($name) || empty($email) || empty($content)) {
            wp_die('Incorrect values');
        }


        wp_insert_post(array(
            'post_author' => 1,
            'post_content' => $content,
            'post_title' => $subject . ' - ' . $name . ' - ' . $email,
            'post_type' => ContactFormCpt::POST_TYPE,
            'post_status' => 'publish'
        ));

        $url = ThemeOptions::get_contact_form_redirect_url();

        if ($url) {
            wp_redirect($url);
        } else {
            wp_redirect(home_url());
        }
    }
}