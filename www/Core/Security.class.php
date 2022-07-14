<?php

namespace App\Core;

class Security
{
    public static function checkRoute($route): bool
    {
        //session_start();
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($_SESSION["user"])) {
            session_start();
            $_SESSION["previous_location"] = $_SERVER["HTTP_REFERER"];
            header("Location: /login");
        } elseif ($_SESSION["user"]['role'] == "admin") {
            return $route["security"] == "admin" || $route["security"] == "employee" || $route["security"] == "user";
        } elseif ($_SESSION["user"]['role'] == "employee") {
            return $route["security"] == "employee" || $route["security"] == "user";
        } elseif ($_SESSION["user"]['role'] == "user") {
            return $route["security"] == "user";
        } else {
            return false;
        }
    }
}