<?php

namespace App\Controllers;

use App\Models\User;
use System\Core\Controller;

class StaffsController extends Controller{
    public function __construct()
    {
        $this->authenticated();

        if(user()->type == 'Staff'){
            flash('Access Denied', 'danger');

            redirect(url('Dashboard'));
        }
    }

    public function index(){
        $users = (new User)->where('type', 'Staff')->paginate();

        view('back/staffs/index.php', compact('users'));
    }

    public function create() {
        view('back/staffs/create.php');
    }

    public function store() {
        $staff = new User;

        $staff->name = $_POST['name'];
        $staff->email = $_POST['email'];
        $staff->password = sha1($_POST['new_password']);
        $staff->phone = $_POST['phone'];
        $staff->address = $_POST['address'];
        $staff->status = $_POST['status'];
        $staff->created_at = now(); 
        $staff->updated_at = now();
        $staff->save();

        flash('Staff Added', 'success');

        redirect(url('staffs'));
    }

    public function edit($id){
        $staff = new User($id);

        view('back/staffs/edit.php', compact('staff'));
    }

    
    public function update($id){
        $staff = new User($id);

        $staff->name = $_POST['name'];
        $staff->phone = $_POST['phone'];
        $staff->address = $_POST['address'];
        $staff->status = $_POST['status'];
        $staff->updated_at = now();
        $staff->save();

        flash('Staff updated', 'success');

        redirect(url("staffs"));
    }

    public function destroy($id){
        $staff = new User($id);

        $staff->delete();

        flash('Staff removed', 'success');

        redirect(url("staffs"));

    }
}


