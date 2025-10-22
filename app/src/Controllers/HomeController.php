<?php

namespace App\Framework\Controllers;

class HomeController {

    public function index() {
        
        \render_view('home');
    }
}