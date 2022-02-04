<?php

namespace App\Core;

class User
{

    public static function cleanLastname($lastname):string
    {
        return strtoupper(trim($lastname)); 
    }

    public static function cleanFirstname($firstname):string
    {
        return ucwords(strtolower((trim($firstname))));
    }

    public static function cleanEmail($email):string
    {
        return strtolower(trim($email));       
    }

}