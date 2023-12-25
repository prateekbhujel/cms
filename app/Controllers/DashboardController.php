<?php

namespace App\Controllers;

use System\Core\Controller;

class DashboardController extends Controller{

    public function __construct()
    {
        $this->authenticated();
    }
    public function index(){
        view("back/dashboard/index.php");
    }
}