<?php

namespace App\Controllers;

use System\Core\Controller;

class LogoutController extends COntroller{
    public function index(){
        unset($_SESSION['user']);

        if(!empty($_COOKIE['cms_user'])){
            setcookie('cms_user', null, time() - 60, '/');
        }

        redirect(url('login'));
    }
}