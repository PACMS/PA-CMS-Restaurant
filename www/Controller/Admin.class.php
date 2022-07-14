<?php

namespace App\Controller;

use App\Core\MysqlBuilder;
use App\Core\Verificator;
use App\Enum\Role;
use App\Model\User as UserModel;
use App\Model\Theme as ThemeModel;
use App\Core\View;
use App\Model\Carte as CarteModel;

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
        @session_start();
        $user = new UserModel();
        $view = new View("dashboard", "back");

        unset($_SESSION["restaurant"]);
        $builder = new MysqlBuilder();
        $restaurant = $builder->select("restaurant", ["id", "name"])
            ->where('favorite', "1")
            ->fetchClass("restaurant")
            ->fetch();
        if($restaurant != false){
            $_SESSION["favoriteRestaurant"] = $restaurant->getId();
        }
        if(!empty($_SESSION["favoriteRestaurant"])){

            $cartes = $builder->select("carte", ["*"])
            ->where('id_restaurant', $_SESSION["favoriteRestaurant"])
            ->fetchClass("carte")
            ->fetchAll();
            $view->assign("cartes", $cartes);
            $reservations = $builder->select("reservation", ["*"])
            ->where('id_restaurant', $_SESSION["favoriteRestaurant"])
            ->where('status', "0")
            ->fetchClass("reservation")
            ->fetchAll();
            if ($restaurant != false) {
                $view->assign("restaurant", $restaurant);
            }
            $view->assign("reservations", $reservations);
            $reservation = new Reservation();
            $nbReservations = $reservation->getReservationsStats();
            $view->assign('stats', $nbReservations);
        }
            $view->assign('title', 'Dashboard');
        $view->assign('description', 'Dashboard du back office');
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

        $data = (new MysqlBuilder())->select('user', ['*'])->where('email', $_SESSION['user']['email'])->fetchClass('user')->fetch();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($user->getUpdateUserForm(), $_POST);

            if (!$errors) {
                $_POST = array_map('htmlspecialchars', $_POST);
                $user->hydrate($_POST);

                if ($user->getPassword() != null) {
                    if (password_verify($_POST['lastPassword'], $data->getPassword())) {
                        if ($user->getEmail() == $_SESSION['user']['email']) {
                            $this->setUserDataWithPassword($user);
                            header("Location: /profile");
                        } else {
                            $emailVerifyUni = (new MysqlBuilder())->select('user', ['email'])->where('email', $user->getEmail())->fetchClass('user')->fetch();
                            if (!$emailVerifyUni) {
                                $this->setUserDataWithPassword($user);
                                header("Location: /profile");
                            } else $errors = ['Adresse email déjà utilisée'];
                        }
                    } else $errors = ['Ancien mot de passe ne correspond pas'];
                } else {
                    $this->setUserData($user);
                    header("Location: /profile");
                }
            }
        }


        $view = new View("profile", "back");
        $view->assign('user', $user);
        $view->assign("data", $data);
        $view->assign("errors", $errors);
        $view->assign('title', 'Profil');
        $view->assign('description', 'Page de profil du back office');
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
        unset($_SESSION["restaurant"]);
        $view = new View("themes", "back");
        $view->assign('title', 'Thèmes');
        $view->assign('description', 'Choix des thèmes pour le front');
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
        unset($_SESSION["restaurant"]);
        $view = new View("users", "back");
        $view->assign('title', 'Gestion des utilisateurs');
        $view->assign("users", $users);
    }

    /**
     * Form update user
     * 
     * @link http://localhost:81/user/update /user/update
     *
     * @return void
     */
    public function updateUser(int $id)
    {

        if (!(new MysqlBuilder())->select('user', ['id'])->where('id', htmlentities($id))->fetchClass('user')->fetch())
            header('Location: /404');


        session_start();
        $user = new UserModel();
        $_SESSION['updateID'] = htmlentities($id);
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($user->getUpdateUsersForm(), $_POST);

            if (!$errors) {
                $_POST = array_map('htmlspecialchars', $_POST);
                $user->hydrate($_POST);
                $emailUser = (new MysqlBuilder())->select('user', ['email'])->where('id', $_SESSION['updateID'])->fetchClass('user')->fetch()->getEmail();

                if ($user->getEmail() == $emailUser) {
                    $this->setUserUpdateData($user);
                    header('Location: /users');
                } else {
                    if (!(new MysqlBuilder())->select('user', ['email'])->where('email', $user->getEmail())->fetchClass('user')->fetch()) {
                        $this->setUserUpdateData($user);
                        header('Location: /users');
                    } else $errors = ['Adresse email déjà utilisée'];
                }
            }
        }

        $view = new View("updateUser", "back");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
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

        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($user->getUserCreationForm(), $_POST);

            if (!$errors) {
                $_POST = array_map('htmlspecialchars', $_POST);
                $user->hydrate($_POST);

                if (!(new MysqlBuilder())->select('user', ['email'])->where('email', $user->getEmail())->fetchClass('user')->fetch()) {
                    $user->generateToken();
                    $token = $user->getToken() . '&email=' . $user->getEmail() . '&date=' . (new \DateTime())->format("YmdHis") . '&tempLink=false';

                    $userData = [
                        'lastname' => $user->getLastname(),
                        'firstname' => $user->getFirstname(),
                        'email' => $user->getEmail(),
                        'role' => $user->getRole(),
                        'status' => $user->getStatus(),
                        'token' => $token
                    ];

                    (new MysqlBuilder())->insert('user', $userData)->execute();

                    $mail = new Mail();
                    $mail->activePasswordMail($user, $token);
                    header('Location: /users');
                } else $errors = ['Adresse email déjà utilisée'];
            }
        }

        $view = new View("createUser", "back");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
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

    /**
     * @param UserModel $user
     * @return void
     */
    private function setUserDataWithPassword(UserModel $user): void
    {
        session_start();

        $userData = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail()
        ];

        $this->setSessionData($userData, $user);
    }

    /**
     * @param UserModel $user
     * @return void
     */
    private function setUserData(UserModel $user): void
    {
        session_start();

        $userData = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'email' => $user->getEmail()
        ];

        $this->setSessionData($userData, $user);
    }

    /**
     * @param UserModel $user
     * @return void
     */
    private function setUserUpdateData(UserModel $user): void
    {
        session_start();

        $userData = [
            'lastname' => $user->getLastname(),
            'firstname' => $user->getFirstname(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'status' => $user->getStatus()
        ];

        (new MysqlBuilder())->update('user', $userData)->where('id', $_SESSION['updateID'])->execute();

        $mail = new Mail();
        $mail->sendConfirmUpdateUserMail($user);

        header("Location: /user/update/" . $_SESSION['updateID']);
    }

    /**
     * @param array $userData
     * @param UserModel $user
     * @return void
     */
    private function setSessionData(array $userData, UserModel $user): void
    {
        (new MysqlBuilder())->update('user', $userData)->where('id', $_SESSION['user']['id'])->execute();

        $_SESSION['user']['lastname'] = $user->getLastname();
        $_SESSION['user']['firstname'] = $user->getFirstname();
        $_SESSION['user']['email'] = $user->getEmail();
    }
}
