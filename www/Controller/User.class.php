<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Core\View;
use App\Model\User as UserModel;

class User {


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

        $view = new View("register");
        $view->assign("user", $user);
    }

    public function verifyToken()
    {
        echo "<pre>";
        print_r($_GET);
        $user = new UserModel();
        if(isset($_GET["email"]) && isset($_GET["token"])) {
            $user->verifyToken($_GET["email"], $_GET["token"]);
        } else {
            echo "L'email ou le token est null! Vérification impossible";
        }
    }






}











