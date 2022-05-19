<?php

namespace App\Controller;

use App\Core\Verificator;
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

    public function updateProfile()
    {
        $user = new UserModel();

        $user->setId($_SESSION['user']['id']);
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);

        Verificator::checkEmail($_POST['email']) ?: die("Email non valide");
        $user->setEmail($_POST['email']);

        
        if (!empty($_POST['passwordOld']) && !empty($_POST['passwordNew']) && !empty($_POST['confirmNewPassowrd'])) {
            Verificator::checkPwd($_POST['passwordNew']) ?: die("Mot de passe non valide");
            $userInfos = $user->getUser(["id" => $_SESSION['user']['id']]);

            if (password_verify($_POST['passwordOld'], $userInfos['password'])) {
                if ($_POST['passwordNew'] === $_POST['confirmNewPassowrd']) {
                    $user->setPassword($_POST['passwordNew']);
                } else {
                    $errors = ["Les mots de passe ne correspondent pas"];
                    die("Les mots de passe ne correspondent pas");
                }
            } else {
                $errors = ["Le mot de passe actuel est incorrect"];
                die("Le mot de passe actuel est incorrect");
            }
        }
        
        $user->save();

        header("Location: /profile");
    }

    /**
     * Show all the themes
     *
     * @link /themes
     * 
     * @return void
     */
    public function themes()
    {
        $view = new View("themes", "back");
    }
}
