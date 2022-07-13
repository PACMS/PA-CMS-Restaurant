<?php

namespace App\Controller;

use App\Core\MysqlBuilder;
use App\Core\View;

class Log
{

    public function index()
    {
        session_start();

        $builder = new MysqlBuilder();
        $logs = $builder->select('activitylog al', ['al.id', 'state', 'firstname', 'lastname', 'email', 'al.created_at'])
            ->rightJoin('user u', 'u.id', 'al.user_id')
            ->fetchClass("activitylog")
            ->fetchAll();

        $view = new View('logs', 'back');
        $view->assign('title', 'Logs');
        $view->assign('logs', $logs);
    }
}