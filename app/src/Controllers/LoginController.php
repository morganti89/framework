<?php

namespace App\Framework\Controllers;

use App\Framework\Helpers\Auth;
use App\Framework\Helpers\Request;
use App\Framework\Models\UserModel;

class LoginController
{

    public function form()
    {
        \render_view('login/form');
    }

    public function login(){
        
        $userModel = new UserModel();
        $user = $userModel->getUser('email');
        $password = Request::getRequest()->get('senha')['senha'];

        if (password_verify( $password, $user->getSenha())) {
            Auth::authenticate()->redirect();
            return;
        }
        redirect('login');
    }

    public function logout(){
        Auth::getInstance()->destroy();
    }
}
