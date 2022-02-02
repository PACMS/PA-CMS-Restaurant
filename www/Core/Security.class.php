<?php

namespace App\Core;

class Security
{

    public static function checkRoute($route):bool
    {
        /*
         * /dashboard:
              Controller: admin
              action: home
              security: true
         *
         */
        return true;
    }


}