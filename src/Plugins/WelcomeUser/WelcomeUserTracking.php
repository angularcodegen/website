<?php

namespace CG\Plugins\WelcomeUser;

class WelcomeUserTracking
{
    private const USER_SOURCE_KEY = 'USER_SOURCE';
    private const USER_SOURCE_ID = 'USER_ID';

    public function __construct()
    {
        add_action('init', array($this, 'tracking'));
    }

    public function tracking(): void
    {
        $ref = $_GET["WELCOME"] ?? '';
        $user_source = $_COOKIE[self::USER_SOURCE_KEY] ?? '';

        if ($ref !== '' && $user_source === '') {
            setcookie(self::USER_SOURCE_KEY, $ref, 0, "/");
            $user_source = $ref;
        }

        if ($user_source === '') {
            return;
        }

        $user_id = $_COOKIE[self::USER_SOURCE_ID] ?? '';
        if ($user_id === '') {
            $user_id = self::generateRandomString();
            setcookie(self::USER_SOURCE_ID, $user_id, 0, "/");
        }

        if ($user_id !== '') {
            $this->save_track_item($user_source, $user_id);
        }
    }

    private static function generateRandomString(): string
    {
        $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 11;

        return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);
    }

    private function save_track_item($user_source, $user_id): void
    {
        $path = wp_upload_dir()['basedir'] . "/" . "tracking/$user_source/";
        wp_mkdir_p($path);

        $file_path = $path . "$user_id.txt";
        $date = current_time('Y-m-d H:i:s');
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        $url = $_SERVER['REQUEST_URI'];

        $log = implode(" - ", array($date, $ip, $url)) . "\n";
        file_put_contents($file_path, $log, FILE_APPEND);
    }

}