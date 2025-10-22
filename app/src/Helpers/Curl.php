<?php

namespace App\Framework\Helpers;

use CurlHandle;

class Curl
{
    private static ?Curl $instance = null;
    private CurlHandle $curl;
    private $response;

    public function __construct() {}

    public static function getInstance(): Curl|array
    {
        if (self::$instance == null) {
            self::$instance = new Curl();
        }
        return self::$instance;
    }

    public function init(): Curl|null {
        $this->curl = curl_init();
        return self::$instance;
    }

    public function url(string $url): Curl|null {
        if($this->curl == null) {
            $this->curl = curl_init();
        }
        curl_setopt($this->curl, CURLOPT_URL, $url);
        return self::$instance;
    }

    public function headers(...$opts) {

    }

    public function make(): Curl|null {
        $this->response = curl_exec($this->curl);
        curl_close($this->curl);
        return self::$instance;
    }
    public function getResponse(): mixed {
        return $this->response;
    }
}
