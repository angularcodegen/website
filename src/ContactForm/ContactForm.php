<?php

namespace CG\ContactForm;


class ContactForm
{
    public static function init(): void
    {
        new AjaxContactForm();
        new CptContactForm();
    }
}