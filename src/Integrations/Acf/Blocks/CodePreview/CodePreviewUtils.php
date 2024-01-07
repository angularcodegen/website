<?php

namespace CG\Integrations\Acf\Blocks\CodePreview;

class CodePreviewUtils
{
    private static int $index = -1;

    /**
     * @deprecated No replacement
     */
    public static function highlight_lines($code): string
    {
        $selector = '%%%\r\n';

        return preg_replace_callback("/$selector/", static function (): string {
            return '';
        }, $code);
    }

}