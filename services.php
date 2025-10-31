<?php

use App\Framework\Helpers\View;

function dd($v): never
{

    echo '<pre 
        style="
            background-color:#333;
            color:white;
            padding:2rem;
            width:100% ">';
    var_dump(value: $v);
    echo '</pre>';
    exit;
}

function debug($message): void
{
    echo '<pre>';
    echo "$message </br>";
    echo '</pre><br>';
}

function render_view(string $viewName, array $viewVariables = []): void
{

    if (file_exists(DIR_VIEW . "components/layout.php")) {

        extract([
            'slot' => $viewName,
        ]);

        if (!empty($viewVariables)) {
            foreach ($viewVariables as $key => $value) {
                extract([
                    $key => $value
                ]);
            }
        }
        load_js(jsFile: ['layout.js']);
        require_once(DIR_VIEW . "components/layout.php");
        require_once(DIR_VIEW . "{$viewName}.php");

        if (!file_exists(DIR_VIEW . $viewName . '.php')) {
            //redirect('http/404');
            return;
        }
    } else {
        require_once(DIR_VIEW . "{$viewName}.php");
    }
}

function load_js(array $jsFile = []): void
{
    foreach ($jsFile as $js) {
        $path = DIR_JS . $js;
        echo "<script defer src=$path></script>";
    }
}

function load_env()
{
    $envFile = __DIR__ . "/.env";

    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with($line, "#")) continue;
            [$key, $value] = explode("=", $line, 2);
            $key = trim($key);
            $value = trim($value, " \"'");
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

function get_env($key): mixed
{
    return $_ENV[$key];
}

function redirect(string $route, array $headers = []): void
{
    Header("Location:" . DIR_PAGE . $route);
}

function insertGET(string $key, mixed $value): void
{
    $_GET[$key] = $value;
}

function removeGET(): void
{
    if (!isset($_GET)) {
        return;
    }
    $url = $_GET["url"];
    $_GET = [];
    $_GET['url'] = $url;
}

function route($route): string
{
    return DIR_PAGE . $route;
}
