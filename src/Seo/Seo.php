<?php

namespace CG\Seo;

class Seo
{

    public static function turn_on(): void
    {
        new TitleSeo();
        new DescriptionSeo();
        new OpenGraphSeo();
    }

}