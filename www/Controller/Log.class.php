<?php

namespace App\Controller;

use App\Core\View;

class Log
{

    public function index()
    {
        session_start();
        $view = new View('logs', 'back');
        $view->assign('title', 'Logs');
       // $view->assign('logs', $log);
        //$view->assign('idrestaurant', $_SESSION["restaurant"]["id"]);
    }
}