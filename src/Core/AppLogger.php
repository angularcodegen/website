<?php

namespace CG\Core;

use Monolog\Formatter\JsonFormatter;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

class AppLogger
{
    private static $logger;

    public static function getLogger(): Logger
    {
        if (self::$logger === null) {
            $logger = new Logger('APP_LOGGER');

            $stream = new RotatingFileHandler(
                filename: self::getPath('APP_LOGS.log'),
                maxFiles: 5,
                level: Level::Debug
            );
            $stream->setFormatter(new JsonFormatter());

            $logger->pushHandler($stream);
        }


        return $logger;
    }

    private static function getPath(string $fileName): string
    {
        $path = __DIR__ . '/../../logs/' . $fileName;

        return $path;

    }


}