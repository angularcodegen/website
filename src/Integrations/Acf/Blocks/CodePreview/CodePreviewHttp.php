<?php

namespace CG\Integrations\Acf\Blocks\CodePreview;

class CodePreviewHttp {

    public static function highlight($language, $code): string {
        if(empty($language) || empty($code)) {
            return $code;
        }

        $params = http_build_query(array(
            "language" => $language,
        ));
        $response = wp_remote_post(
            "https://functions.codegen.studio/api/code/highlight?".$params,
            array(
                'body' => $code,
                'timeout' => 1,
            ),
        );

        if(is_wp_error($response)) {
            return $code;
        }

        return $response['body'];
    }

    public static function format($language, $code): string {
        if(empty($language) || empty($code)) {
            return $code;
        }

        $params = http_build_query(array(
            "language" => $language,
        ));
        $response = wp_remote_post(
            "https://functions.codegen.studio/api/code/format?".$params,
            array(
                'body' => $code,
                'timeout' => 1,
                'headers' => array(
                    'Content-Type' => 'text/plain',
                ),
            ),
        );

        if(is_wp_error($response)) {
            return $code;
        }

        return $response['body'];
    }
}