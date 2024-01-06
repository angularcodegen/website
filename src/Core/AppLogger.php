<?php

namespace CG\Core;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class AppLogger
{
    private static $logger;

    public static function getLogger(): Logger
    {
        if (self::$logger === null) {
            $logger = new Logger('APP_LOGGER');
            $logger->pushHandler(
                new StreamHandler(
                    self::getPath('APP_LOGS.log'),
                    Level::Debug
                )
            );
        }


        return $logger;
    }

    private static function getPath(string $fileName): string
    {
        $path = __DIR__ . '/../../logs/' . $fileName;

        return $path;

    }


}