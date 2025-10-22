<?php

namespace App\Framework\Controllers;

use App\Framework\Helpers\Auth;
use App\Framework\Models\UserModel;

class UserController extends Controller {

    public function userForm(){
        return render_view("user/form");
    }

    public function createUser() {
        $lastId = UserModel::save();
        if ($lastId > 0){
            Auth::getInstance()->authenticate();
            return render_view("home");
        }
    }
}