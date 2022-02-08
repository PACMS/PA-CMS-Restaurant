<?php

namespace App\Controller;

use App\Core\User as UserClean;
use App\Core\Verificator;
use App\Controller\Mail;
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

            print_r($result);
        }

        $view = new View("Register");
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
        Mail::sendConfirmMail($user->getToken(), $user->getEmail());
        //$user->save();
        echo "<pre>";
        echo ("Token créé ". $user->getToken());

        //envoie du mail 
        //click sur http://localhost/verifyToken?token=<token>?email=<email>

    }

    public function verifyToken()
    {
        echo "<pre>";
    /*    $user = new UserModel();
      //  $user->setEmail("thibautsembeni@gmail.com");

      //  $token = "741b211aac3839d3a426bbb476df3da095f1fce1cb195ba59d65fb42d65af821ca6fa7ef76bd1e8f8a704b1b8d75393fb0b7942ec6d12723f8be28077ae2e58b5d95ae384eebbcb09cfde3dc593dba6fca24407611a1241e710d48d1ea8be9e84930997bf51309f2893d7e00d406d8620317dea18e032c6400ec981e5da1a77";

        $user->verifyToken($token);
*/


        die("vérif token");
    }






}











