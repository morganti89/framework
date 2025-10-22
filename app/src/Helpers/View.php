<?php

namespace App\Framework\Helpers;


class View {
    /**
     * Summary of viewNotRender
     * Devolve lista de views em que o layout não será renderizado
     * return @var array
     */
    private static array $viewNotRender = [
        'login'
    ];
    public static function viewExceptions() {
        return self::$viewNotRender;
    }
}