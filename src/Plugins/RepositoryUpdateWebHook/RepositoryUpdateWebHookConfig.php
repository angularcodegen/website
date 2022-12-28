<?php

namespace CG\Plugins\RepositoryUpdateWebHook;

class RepositoryUpdateWebHookConfig
{
    public static function get_update_theme_repository_webhook_secret(): string
    {
        return get_field('1bea5ce805d94d4cbad97831133cd261', 'option') ?? '';
    }



}
