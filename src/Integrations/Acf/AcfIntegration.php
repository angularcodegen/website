<?php

namespace CG\Integrations\Acf;

use CG\Integrations\Acf\Blocks\Alert\AlertBlock;
use CG\Integrations\Acf\Blocks\Callout\CalloutBlock;
use CG\Integrations\Acf\Blocks\CodePreview\CodePreviewBlock;
use CG\Integrations\Acf\Blocks\Consultation\Container\ConsultationContainerBlock;
use CG\Integrations\Acf\Blocks\Consultation\Item\ConsultationItemBlock;
use CG\Integrations\Acf\Blocks\Demo\DemoBlock;
use CG\Integrations\Acf\Blocks\Excerpt\ExcerptBlock;
use CG\Integrations\Acf\Blocks\Icon\IconBlock;
use CG\Integrations\Acf\Blocks\Link\LinkBlock;
use CG\Integrations\Acf\Blocks\TableOfContents\TableOfContentsBlock;
use ReflectionClass;
use ReflectionException;

class AcfIntegration
{


    public static function turn_on(): void
    {
        new CalloutBlock();
        new AlertBlock();
        new CodePreviewBlock();
        new ExcerptBlock();
        new DemoBlock();
        new IconBlock();
        new LinkBlock();
        new TableOfContentsBlock();

        new ConsultationContainerBlock();
        new ConsultationItemBlock();

        new AcfJsonLoader();
        new AcfDisableUpdate();

        new AcfThemeOptions();
    }

    /**
     * @throws ReflectionException
     */
    public static function get_style_uri_by_class_name($class): string
    {
        $ref = new ReflectionClass($class);
        $path = $ref->getFileName();
        $relative_path = str_replace(get_theme_file_path(), "", $path);
        $uri = get_theme_file_uri($relative_path);
        return rtrim($uri, "php") . "css";
    }

    /**
     * @throws ReflectionException
     */
    public static function get_template_path_by_class_name($class): string
    {
        $ref = new ReflectionClass($class);
        $path = $ref->getFileName();
        return rtrim($path, "php") . "phtml";
    }

    public static function get_block_css(string $directory, $file_name): string
    {
        $names = explode('/', $directory);
        $dir_name = end($names);
        return get_theme_file_uri('src/Integrations/Acf/Blocks/' . $dir_name . '/' . $file_name);
    }


}