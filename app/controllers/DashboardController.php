<?php

namespace app\controllers;
use app\framework\database\Connection;
class DashboardController
{
    public function index(){
        view('app/dashboard');
    }
}