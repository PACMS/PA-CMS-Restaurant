<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Core\OAuth;
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

    public function register()
    {
        $user = new UserModel();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($user->getCompleteRegisterForm(), $_POST + $_FILES);

            if(!$errors) {
                $user = new UserModel();
                $user->hydrate($_POST);
                $user->save();

                /////////// redirection vers le dashboard à faire
            }
        }

        $view = new View("register");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
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
