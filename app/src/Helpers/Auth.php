<?php

namespace App\Framework\Helpers;

class Auth
{

    private static ?Auth $instance = null;

    public function __construct() {}
    public static function getInstance(): Auth|null
    {
        if (self::$instance == null) {
            self::$instance = new Auth();
        }
        return self::$instance;
    }
    public static function authenticate(): Auth|null
    {
        $_SESSION['logged'] = true;
        return Auth::getInstance();
    }
    public static function isAuth(): bool
    {
        return isset($_SESSION['logged']) && $_SESSION['logged'] == true;
    }

    public function redirect(string $url = ''): void
    {
        if ($url != '') redirect($url);
        redirect('/');
    }

    public function destroy(): void {
        session_destroy();
        redirect('/');
    }
}
