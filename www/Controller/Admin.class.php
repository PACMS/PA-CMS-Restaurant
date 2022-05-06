<?php

namespace App\Controller;

use App\Model\User as UserModel;
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

    /**
     * Show the list of users
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
     * Update user
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
     * Delete user
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
