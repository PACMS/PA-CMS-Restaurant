<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Model\User as UserModel;
use App\Model\Theme as ThemeModel;
use App\Core\View;

/**
 * Admin controller
 * 
 * @category Controller
 * 
 * @package App\Controller
 *
 * @access public
 * 
 * @author PACMS <pa.cms.test@gmail.com>
 * 
 */
class Admin
{
    /**
     * Dashboard
     * 
     * @link http://localhost:81/Dashboard /dashboard
     *
     * @return void
     */
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
        session_start();
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
                    // die("Les mots de passe ne correspondent pas");
                }
            } else {
                $errors = ["Le mot de passe actuel est incorrect"];
                // die("Le mot de passe actuel est incorrect");
            }
        }
        
        $user->save();
        $_SESSION['user']['email'] = $user->getEmail();
        $_SESSION['user']['firstname'] = $user->getFirstname();
        $_SESSION['user']['lastname'] = $user->getLastname();
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
        $theme = new ThemeModel();
        $themes = $theme->getAllThemes();
        
        $view = new View("themes", "back");
        $view->assign("themes", $themes);
    }

    /**
     * Show the list of users
     * 
     * @link http://localhost:81/users /users
     *
     * @return void
     */
    public function users()
    {
        $user = new UserModel();
        $users = $user->getAll();

        foreach ($users as $user) {
            $user->createdAt = date("d/m/Y H\hi:s", strtotime($user->createdAt));
            $user->updatedAt = date("d/m/Y H\hi:s", strtotime($user->updatedAt));
        }

        $view = new View("users", "back");
        $view->assign("users", $users);
        $view->assign("user", $user);
    }

    /**
     * Form create user
     * 
     * @link http://localhost:81/user/create /user/create
     *
     * @return void
     */
    public function createUser()
    {
        $user = new UserModel();

        $view = new View("createUser", "back");
        $view->assign("user", $user);
    }

    /**
     * Form update user
     * 
     * @link http://localhost:81/user/update /user/update
     *
     * @return void
     */
    public function updateUser()
    {
        $user = new UserModel();

        $userId = htmlspecialchars($_GET['id']);

        $userInfos = $user->getUserById($userId);
        $view = new View("updateUser", "back");
        $view->assign("user", $user);
        $view->assign("userInfos", $userInfos);
    }

    /**
     * Save an user
     * 
     * @link http://localhost:81/user/save /user/save
     *
     * @return void
     */
    public function saveUser()
    {
        $user = new UserModel();
        $user->hydrate($_POST);
        $user->save();
        header("Location: /users");
    }

    /**
     * Delete an user
     * 
     * @link http://localhost:81/user/delete /user/delete
     *
     * @return void
     */
    public function deleteUser()
    {
        $user = new UserModel();
        $userId = htmlspecialchars($_GET['id']);
        $user->deleteUser($userId);
        header("Location: /users");
    }
}
