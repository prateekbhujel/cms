<?php

namespace App\Controllers;

use App\Models\User;
use System\Core\Controller;

class LoginController extends Controller{

    public function index(){
        view('back/login/index.php');
    }
    public function check(){
        $user = new User;

        $check = $user->where('email', $_POST['email'])
            ->where('password', sha1($_POST['password']))
            ->where('status', 'Active')
            ->first();

        if(!is_null($check)){
            $_SESSION['user'] = $check->id;

            if(!empty($_POST['remember']) && ($_POST['remember'] == 'yes')){
                setcookie('cms_user', $check->id, time() + 30 * 24 * 60 * 60, '/');
            }

            redirect(url('dashboard'));
        }

        else{
            flash('Invalid Email or Password', 'danger');
            redirect(url('login'));
        }
    }
}
