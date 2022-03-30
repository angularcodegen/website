<?php

namespace CG\Integrations\Acf\Blocks\CodePreview;

use Exception;
use Highlight\Highlighter;

class CodePreviewUtils


{
    private static int $index = -1;

    public static function highlight_lines($code): string
    {
        $selector = '%%%\r\n';

        self::$index = -1;
        return preg_replace_callback("/$selector/",
            static function ($matches): string {
                self::$index++;
                return self::$index % 2 === 0 ? '<mark>' : '</mark>';
            },
            $code);
    }

    /**
     * @throws Exception
     */
    public static function highlight($language, $code): string
    {
        if (empty($language)) {
            return $code;
        }
        if ($language === "angular") {
            return self::highlight_angular($code);
        }

//        $response = wp_remote_post('http://127.0.0.1:3000', array(
//            'body' => array(
//                'language' => $language,
//                'code' => $code
//            ),
//        ));
//        return wp_remote_retrieve_body($response);

        $hl = new Highlighter();
        return $hl->highlight($language, $code)->value;
    }

    /**
     * @throws Exception
     */
    private static function highlight_angular($code): string
    {
        $hl = new Highlighter();

        $html = self::extract_template($code);
        $without_template = str_replace($html, "-------------------------", $code);

        $parsed_ts = $hl->highlight('typescript', $without_template)->value;
        $parsed_html = $hl->highlight('html', $html)->value;

        return str_replace('<span class="hljs-string">`-------------------------`</span>', "`" . $parsed_html . "`", $parsed_ts);
    }

    private static function extract_template($code): string
    {
        // find "template: `"
        $open_char = strpos($code, 'template: `') + strlen('template: `');

        // find end of template: "`"
        $close_char = strpos($code, '`', $open_char);

        return substr($code, $open_char, $close_char - $open_char);
    }


}