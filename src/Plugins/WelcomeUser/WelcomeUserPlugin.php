<?php

namespace CG\Plugins\WelcomeUser;

class WelcomeUserPlugin
{

    public static function turn_on(): void
    {
        new WelcomeUserCpt();
        new WelcomeUserTracking();
        new WelcomeUserPopup();
    }

}