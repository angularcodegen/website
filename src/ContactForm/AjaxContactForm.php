<?php

namespace CG\ContactForm;

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
        $subject = $_REQUEST['subject'];
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $content = $_REQUEST['content'];

        if (empty($subject ?? $name ?? $email ?? $content)) {
            wp_die('Incorrect values');
        }


        wp_insert_post(
            array(
                'post_author' => 1,
                'post_content' => $content,
                'post_title' => $subject . ' - ' . $name . ' - ' . $email,
                'post_type' => CptContactForm::POST_TYPE,
                'post_status' => 'publish'
            )
        );

        wp_redirect(home_url());


    }
}