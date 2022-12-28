<?php

namespace CG\Plugins\RepositoryUpdateWebHook;

use ErrorException;

class RepositoryUpdateWebHookConfig
{
    /**
     * @throws ErrorException
     */
    public static function get_update_theme_repository_webhook_secret(): string
    {
        $value = get_field('1bea5ce805d94d4cbad97831133cd261', 'option');

        if ($value === null) {
            throw new ErrorException('Signature not found');
        }

        return $value;
    }


}
