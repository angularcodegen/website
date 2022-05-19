<?php

namespace CG\Plugins\ContactForm;


use CG\Plugins\ContactForm\Blocks\ContactForm\ContactFormBlock;

class ContactForm
{
    public static function init(): void
    {
        new AjaxContactForm();
        new ContactFormCpt();

        new ContactFormBlock();
    }
}