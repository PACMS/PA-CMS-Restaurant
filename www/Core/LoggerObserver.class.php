<?php

namespace App\Core;

use App\Core\Auth;
use App\Core\AuthObserver;

class LoggerObserver implements AuthObserver {

    function update(Auth $auth, string $event) {
        die("Auth logger: $event\n");
    }
}