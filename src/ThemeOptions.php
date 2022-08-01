<?php

namespace CG;

class ThemeOptions
{
    public static function get_github_organization(): string|null
    {
        return get_field('6155A9ADF09E406BBB3AA0611D48106C', 'option');
    }

    public static function get_contact_form_redirect_url(): string|null
    {
        return get_field('58846561C82443CFB9A1CB9009B3C2B7', 'option');
    }

    public static function get_default_thumbnail(): array
    {
        return get_field('B3A0C8866909406EB6D6252EBE32079F', 'option');
    }

}