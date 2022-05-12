<?php

namespace CG\Gutenberg;

class Gutenberg
{

    public static function turn_on(): void
    {
        new GlobalCssGutenberg();
        new HeaderIdAttribute();
    }

}