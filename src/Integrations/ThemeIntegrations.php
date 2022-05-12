<?php

namespace CG\Integrations;

use CG\Integrations\Acf\AcfIntegration;
use CG\Integrations\GoogleTagManager\GoogleTagManagerIntegration;

class ThemeIntegrations
{
    public static function turn_on_all():void {
        AcfIntegration::turn_on();
        GoogleTagManagerIntegration::turn_on();
    }

}