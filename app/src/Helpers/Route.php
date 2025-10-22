<?php

namespace App\Framework\Helpers;

use App\Framework\Controllers\Controller;

class Route
{
    public static ?Route $instance = null;
    private string $controller = '';
    private string $method = '';
    private string $route = '';
    private string $currentRoute;

    public function __destruct()
    {

        if (
            self::getInstance()->controller == null &&
            self::getInstance()->method == null
        ) {
            redirect('404');
        }



        self::getInstance()->instanciate(
            [
                self::getInstance()->controller,
                self::getInstance()->method
            ]
        );
    }

    private static function getInstance(): Route|null
    {
        if (self::$instance == null) {
            self::$instance = new Route();
        }
        return self::$instance;
    }
    /**
     * @param string $route
     * @param array $controller array thats contains the class controller and the funcition
     * that is invoked
     */
    public static function get(string $route, $controller = []): Route
    {

        self::getInstance()->currentRoute = $route;



        if (self::isURL($route) && empty($_POST)) {
            self::getInstance()->route = $route;
            self::getInstance()->controller = $controller[0];
            self::getInstance()->method = $controller[1];
        }
        return self::getInstance();
    }

    public static function post(string $route, $controller = []): Route
    {
        if (self::isURL($route) && !empty($_POST)) {
            self::getInstance()->controller = $controller[0];
            self::getInstance()->method = $controller[1];
        }
        return self::getInstance();
    }

    public static function delete(string $route, $controller = []): Route
    {
        if (self::isURL($route) && !empty($_POST)) {
            self::getInstance()->controller = $controller[0];
            self::getInstance()->method = $controller[1];
        }
        return self::getInstance();
    }

    public static function authRequired()
    {

        if (self::getInstance()->route != self::getInstance()->currentRoute) return;

        if (Auth::isAuth() == false) {
            redirect("login");
        }
    }

    private function instanciate($controller = []): void
    {
        $c = new $controller[0]();
        $f = $controller[1];
        $c->$f();
    }

    private static function isURL(string $route): bool
    {



        $url = self::parseURL()[0] ?? '';
        $method = self::parseURL()[1] ?? '';
        $parameters = self::parseURL()[2] ?? '';

        if ($url == "") {
            $url = "/";
        }

        if ($method != '' && $parameters == '') {
            return strcmp("$url/$method", $route) == 0;
        }

        if ($parameters != '' && $route != '/') {
            $url = "$url/$method";

            if (str_contains($route, '{')) {
                if (preg_match("/\{([A-Za-z0-9_]+)\}/", $route, $matches)) {
                    removeGET();
                    $key = $matches[1] ?? null;
                    if (!$key) return false;
                    insertGET($key, $parameters);
                    $route = preg_replace("/\/\{([A-Za-z0-9_]+)\}/", "", $route);
                }
                return strcmp($url, $route) == 0;
            }
        }
        return strcmp($url, $route) == 0;
    }

    private static function parseURL(): array
    {
        return explode('/', rtrim($_GET['url']), FILTER_SANITIZE_URL);
    }
}
