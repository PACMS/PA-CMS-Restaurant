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
        $user->generateToken();

        if (!empty($_POST)) {
            $result = Verificator::checkForm($user->getCompleteRegisterForm(), $_POST + $_FILES);
            if($result){
                var_dump($result);
            }else{
                $user = new UserModel();
                $user->hydrate($_POST);
                $user->generateToken();
                $user->save();
                echo "Enregistrement effectué";
            }
        }

        $view = new View("register");
        $view->assign("user", $user);
    }

    public function createToken()
    {

        $view = new View("token");
        //$view->assign("user", $user);

    }

    public function getToken()
    {
        $user = new UserModel();
        //$user->setId(1);
        $user->setEmail("thibautsembeni@gmail.com");
        $user->setPassword("Test1234");
        $user->setLastname("SembEnI   ");
        $user->setFirstname("  THIBaut   ");
        $user->generateToken();

        //$user->save();
        echo "<pre>";
        echo ("Token créé ". $user->getToken() . "\n");
        //envoie du mail 
        //click sur http://localhost/verifyToken?token=<token>?email=<email>
        $data = array(
            "token" => $user->getToken(),
            "email" => $user->getEmail()
        );
        echo urldecode("http://localhost" . http_build_query($data)) . "\n";

        die();
    }

    public function verifyToken()
    {
        echo "<pre>";
        echo $this->getToken();
        print_r($_POST);
        print_r($_GET);
        die();
        $user = new UserModel();

        $user->verifyToken($_POST["email"], $_POST["token"]);
    }






}











