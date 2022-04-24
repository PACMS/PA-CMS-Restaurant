<?php

namespace App\Controller;

use App\Model\User as UserModel;
use App\Core\View;

class Admin
{
    public function home()
    {
        $user = new UserModel();

        $view = new View("dashboard", "back");
        $view->assign("user", $user);
    }

    public function sendMail()
    {
    }

    public function profile()
    {
        $view = new View("profile", "back");
    }

    public function users()
    {
        $user = new UserModel();
        $users = $user->getAll();

        foreach ($users as $user ){
            $user->createdAt = date("d/m/Y H\hi:s", strtotime($user->createdAt));
            $user->updatedAt = date("d/m/Y H\hi:s", strtotime($user->updatedAt));
        }

        $view = new View("users", "back");
        $view->assign("users", $users);
        $view->assign("user", $user);
    }
}
