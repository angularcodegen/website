<?php

namespace CG\Integrations\Acf\Blocks\CodePreview;

use CG\Core\AppLogger;

class CodePreviewHttp
{

    public static function highlight($language, $code): string
    {
        if (empty($language) || empty($code)) {
            return $code;
        }

        $params = http_build_query(
            array(
                "language" => $language,
            )
        );


        $curTime = microtime(true);
        $response = wp_remote_post(
            "https://functions.codegen.studio/api/code/highlight?" . $params,
            array(
                'body' => $code,
                'timeout' => 1,
            ),
        );
        $timeConsumed = round(microtime(true) - $curTime, 3) * 1000;

        AppLogger::getLogger()->info("Code has been highlighted", [
            "requestTime" => $timeConsumed,
            "unit" => "ms"

        ]);

        if (is_wp_error($response)) {
            return $code;
        }

        return $response['body'];
    }

    public static function format($language, $code): string
    {
        if (empty($language) || empty($code)) {
            return $code;
        }

        $params = http_build_query(
            array(
                "language" => $language,
            )
        );

        $curTime = microtime(true);
        $response = wp_remote_post(
            "https://functions.codegen.studio/api/code/format?" . $params,
            array(
                'body' => $code,
                'timeout' => 1,
                'headers' => array(
                    'Content-Type' => 'text/plain',
                ),
            ),
        );
        $timeConsumed = round(microtime(true) - $curTime, 3) * 1000;


        AppLogger::getLogger()->info("Code has been formatted", [
            "requestTime" => $timeConsumed,
            "unit" => "ms"

        ]);

        if (is_wp_error($response)) {
            return $code;
        }

        return $response['body'];
    }
}