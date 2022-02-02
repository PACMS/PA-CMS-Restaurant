<?php

namespace App\Core;

class User
{

    public static function cleanLastname($lastname):string
    {
        $lastname = strtoupper(trim($lastname));
        return $lastname;
    }


}