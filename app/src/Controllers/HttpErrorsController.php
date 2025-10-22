<?php

namespace App\Framework\Controllers;

use App\Framework\Controllers\Controller;

class HttpErrorsController extends Controller {
    public function index() {
        render_view('http/404');
    }
}
