<?php

namespace CG\Plugins\RepositoryUpdateWebHook;

use WP_Error;
use WP_REST_Controller;
use WP_REST_Response;
use WP_REST_Server;

class RepositoryUpdateWebHookController extends WP_REST_Controller
{

    public function __construct()
    {
        $this->namespace = 'theme/v1';
        $this->rest_base = 'update';

        add_action('rest_api_init', function () {
            $this->register_routes();
        });
    }

    public function register_routes(): void
    {
        register_rest_route($this->namespace, '/' . $this->rest_base, array(
            array(
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => array($this, 'get_items'),
                'permission_callback' => array($this, 'create_item_permissions_check'),
            ),
        ));
    }

    public function create_item_permissions_check($request): bool
    {
        $secret = $request->get_json_params()['hook']['config']['secret'];
        $saved_secret = RepositoryUpdateWebHookConfig::get_update_theme_repository_webhook_secret();
        return $secret === $saved_secret;
    }

    public function get_items($request): WP_Error|WP_REST_Response
    {
        $theme_path = get_template_directory();
        chdir($theme_path);
        $output = shell_exec('git pull');

        if ($output === null) {
            return new WP_Error('PULL FAILED');
        }

        return new WP_REST_Response(null, 204);
    }

}