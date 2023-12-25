<?php

namespace App\Controllers;

use System\Core\Controller;

class PasswordController extends Controller{
    public function __construct()
    {
        $this->authenticated();
    }

    public function edit(){
        view('back/password/edit.php');
    }

    public function update(){
        $user = user();

        if ($user->password == sha1($_POST['old_password'])) {
            $user->password = sha1($_POST['new_password']);
            $user->save();

            flash('Password is updated', 'success');
        }
        else{
            flash('Old password is incorrect', 'danger');
        }

        redirect(url('password/edit'));
    }
}
