<?php

namespace CG\Integrations\Acf;

class AcfDisableUpdate
{
    public function __construct()
    {
        add_filter('site_transient_update_plugins', array($this, 'remove_acf_update'));

    }

    public function remove_acf_update($value)
    {
        unset($value->response['advanced-custom-fields-pro/acf.php']);
        return $value;
    }
}