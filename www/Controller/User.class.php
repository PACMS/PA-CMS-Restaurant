<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;


class User{


    public function login()
    {
        $view = new View("login");
        $view->assign("title", "Ceci est le titre de la page login");
    }

    public function logout()
    {
        echo "Se déconnecter";
    }


    public function register()
    {

        $user = new UserModel();


        if (!empty($_POST)) {
            $result = Verificator::checkForm($user->getCompleteRegisterForm(), $_POST + $_FILES);
            if($result){
                var_dump($result);
            }else{
                $user = new UserModel();
                $user->hydrate($_POST);
                $user->save();
                echo "Enregistrement effectué";
            }
        }

        $view = new View("Register");
        $view->assign("user", $user);
    }

}











