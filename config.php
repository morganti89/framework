<?php
$innerFolder = 'projetos/framework/';

define('DIR_PAGE', "http://{$_SERVER['HTTP_HOST']}/{$innerFolder}");
if (substr($_SERVER['DOCUMENT_ROOT'], -1) == '/') {
    define('DIR_REQ', "{$_SERVER['DOCUMENT_ROOT']}{$innerFolder}");
} else {
    define('DIR_REQ', "{$_SERVER['DOCUMENT_ROOT']}/{$innerFolder}");
}

define('DIR_IMG', DIR_PAGE . "public/img/");
define('DIR_CSS', DIR_PAGE . "public/css/");
define('DIR_JS', DIR_PAGE . "public/scripts/");
define('DIR_LIBS', DIR_PAGE . "public/libs/");

define('DIR_VIEW', DIR_REQ . "public/view/");

