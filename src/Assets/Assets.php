<?php

namespace CG\Assets;

class Assets
{

    public static function get_url(string $name): string
    {
        return get_template_directory_uri() . '/src/Assets/' . $name;
    }

}