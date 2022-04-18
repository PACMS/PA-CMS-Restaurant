<?php

namespace App\Controller;

use App\Model\User as UserModel;
use App\Core\View;

class Admin{


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


}