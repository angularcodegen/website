<?php

namespace CG\Plugins\RepositoryUpdateWebHook;


class RepositoryUpdateWebHook
{
    public static function init(): void
    {
        new RepositoryUpdateWebHookController();
    }

}
