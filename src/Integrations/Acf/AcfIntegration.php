<?php

namespace CG\Integrations\Acf;

use CG\Integrations\Acf\Blocks\Alert\AlertBlock;
use CG\Integrations\Acf\Blocks\Callout\CalloutBlock;
use CG\Integrations\Acf\Blocks\CodePreview\CodePreviewBlock;
use CG\Integrations\Acf\Blocks\ContactForm\ContactFormBlock;
use CG\Integrations\Acf\Blocks\Demo\DemoBlock;
use CG\Integrations\Acf\Blocks\Excerpt\ExcerptBlock;

class AcfIntegration
{


    public static function turn_on(): void
    {
        new ContactFormBlock();
        new CalloutBlock();
        new AlertBlock();
        new CodePreviewBlock();
        new ExcerptBlock();
        new DemoBlock();

        new AcfJsonLoader();
        new AcfDisableUpdate();

        new AcfThemeOptions();
    }

    public static function get_block_css(string $directory, $file_name): string
    {
        $names = explode('/', $directory);
        $dir_name = end($names);
        return get_theme_file_uri('src/Integrations/Acf/Blocks/' . $dir_name . '/' . $file_name);
    }

}