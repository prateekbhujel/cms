<?php

namespace App\Controllers;

use System\Core\Controller;

class ProfileController extends Controller{

    public function __construct()
    {
        $this->authenticated();
    }

    public function edit(){
        $user = user(); 

        view('back/profile/edit.php', compact('user'));
    }

    public function update(){
        $user = user();

        $user->name = $_POST['name'];
        $user->phone = $_POST['phone'];
        $user->address = $_POST['address'];
        $user->save();

        flash('Profile updated', 'success');

        redirect(url('profile/edit'));
    }
}