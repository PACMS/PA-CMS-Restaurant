<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Controller\Mail;
use App\Core\View;
use App\Core\OAuth;
use App\Model\User as UserModel;

class User
{
    public function login()
    {
        $user = new UserModel();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($user->getLoginForm(), $_POST + $_FILES);

        }


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

    public function register()
    {
        $user = new UserModel();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($user->getCompleteRegisterForm(), $_POST + $_FILES);

            if(!$errors) {
                $user->hydrate($_POST);
                $user->save();
                /////////// redirection vers le dashboard à faire
            }
        }

        $view = new View("register");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
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



    
    public function loginVerify()
    {
        $user = new UserModel();
        

        if (!empty($_POST)) {
            Verificator::checkForm(
                $user->getLoginForm(),
                $_POST + $_FILES
            );
            // print_r($result);
        }
        
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        
        $params = ["email" => 'email'];
        
        $user->verifyUser($params);
        
        
        $view = new View("loginVerify");
        $view->assign("title", "Vérification");
        $view->assign("user", $user);
    }

    public function googleConnect ()
    {
        $token = new OAuth($_GET['code']);
        $info = $token->google();
        $user = new UserModel();

        if (!$user->findOneBy(['email' => $info->email])) {
            $user->setFirstname($info->given_name);
            $user->setLastname($info->family_name);
            $user->setEmail($info->email);
            $user->setStatus(true);
            $user->save();
        }

        new View('dashboard');
    }

    public function facebookConnect ()
    {
        $token = new OAuth($_GET['code']);
        $info = $token->facebook();
        $user = new UserModel();

        if (!$user->findOneBy(['email' => $info->email])) {
            $user->setFirstname($info->first_name);
            $user->setLastname($info->last_name);
            $user->setEmail($info->email);
            $user->setStatus(true);
            $user->save();
        }

        new View('dashboard');
    }

    public function lostPassword() 
    {
        $user = new UserModel();

        $view = new View("lostPassword");
        $view->assign("title", "Mot de passe oublié");
        $view->assign("user", $user);
    }

    public function lostPasswordAction() 
    {
        $user = new UserModel();

        $view = new View("lostPasswordAction");
        $view->assign("title", "Mail d'oubli de mdp");
        $view->assign("user", $user);
      
        // if (!empty($_POST)) {
        //     Verificator::checkForm(
        //         $user->getLoginForm(),
        //         $_POST + $_FILES
        //     );
        // }

        $email = $_POST['email'];
    }

    public function logout()
    {
        echo "Se déconnecter";
    }

}
