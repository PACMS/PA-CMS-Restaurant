<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User
{
    public function login()
    {
        $user = new UserModel();

        // $user->setEmail("vivian.fr@free.fr");
        // $user->setPassword("Test1234");
        // $user->setLastname("Ruhlmann");
        // $user->setFirstname("Vivian");
        // $user->generateToken();
        // $user->save();

        // if (!empty($_POST)) {
        //     $result = Verificator::checkForm($user->getLoginForm(), $_POST + $_FILES);

        //     print_r($result);
        // }

        $view = new View("login");
        $view->assign("title", "Connexion");
        $view->assign("user", $user);
    }

    public function loginVerify()
    {
        $user = new UserModel();

        // if (!empty($_POST)) {
        //     $result = Verificator::checkForm($user->getLoginForm(), $_POST + $_FILES);

        //     print_r($result);
        // }

        $user->verifyUser();

        $view = new View("loginVerify");
        $view->assign("title", "Vérification");
        $view->assign("user", $user);
    }

    public function logout()
    {
        echo "Se déconnecter";
    }


    public function register()
    {

        $user = new UserModel();


        if (!empty($_POST)) {
            Verificator::checkForm($user->getCompleteRegisterForm(), $_POST + $_FILES);

            // print_r($result);
        }

        $view = new View("Register");
        $view->assign("user", $user);
    }
}
