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

    /**
     * Show profile of the user
     *
     * @link /profile
     * 
     * @return void
     */
    public function profile()
    {
        $user = new UserModel();
        $userInfos = $user->getUser(["id" => $_SESSION['user']['id']]);
        $view = new View("profile", "back");
        $view->assign("userInfos", $userInfos);
    }
}
