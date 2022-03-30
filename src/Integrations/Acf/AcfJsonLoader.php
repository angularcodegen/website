<?php

namespace CG\Integrations\Acf;

class AcfJsonLoader
{

    public function __construct()
    {
        add_filter('acf/settings/save_json', array($this, 'my_acf_json_save_point'));
        add_filter('acf/settings/load_json', array($this, 'my_acf_json_load_point'));
    }

    function my_acf_json_save_point($path): string
    {
        return __DIR__ . '/Json';
    }

    public function my_acf_json_load_point($paths)
    {
        $paths[] = __DIR__ . '/Json';
        return $paths;
    }
}