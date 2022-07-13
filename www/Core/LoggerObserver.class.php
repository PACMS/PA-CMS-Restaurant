<?php

namespace App\Core;

use App\Core\Auth;
use App\Core\AuthObserver;
use Cassandra\Cluster\Builder;

class LoggerObserver implements AuthObserver {

    function update(Auth $auth, string $event) {
        if ($event = 'user:login'){
            $request = new MysqlBuilder();
            $request->insert("activitylog", ['user_id' => $_SESSION['user']['id'], 'state' => 'login'])
                ->fetchClass("activitylog")
                ->execute();
        }

    }
}