<?php

namespace CG\Plugins\RepositoryUpdateWebHook;

use ErrorException;
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
                'callback' => array($this, 'create_item'),
                'permission_callback' => array($this, 'create_item_permissions_check'),
            ),
        ));
    }

    /**
     * @throws ErrorException
     */
    public function create_item_permissions_check($request): bool
    {
        $body = $request->get_body();
        $secret = RepositoryUpdateWebHookConfig::get_update_theme_repository_webhook_secret();
        $signature = 'sha256=' . hash_hmac('sha256', $body, $secret);

        $received_signature = $request->get_header('X-Hub-Signature-256');
        return $signature === $received_signature;
    }

    public function create_item($request): WP_Error|WP_REST_Response
    {
        $theme_path = get_template_directory();
        chdir($theme_path);
        $output = shell_exec('git pull 2>&1');

        if ($output === null) {
            return new WP_Error('PULL FAILED', $output);
        }

        return new WP_REST_Response(null, 204);
    }

}