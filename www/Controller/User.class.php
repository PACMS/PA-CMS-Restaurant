<?php

/**
 * PHP version 8.1
 */
namespace App\Controller;

use App\Controller\Mail;
use App\Core\Auth;
use App\Core\LoggerObserver;
use App\Core\MysqlBuilder;
use App\Core\Verificator;
use App\Core\View;
use App\Core\OAuth;
use App\Model\User as UserModel;
/**
 * User Controller
 * 
 * @category Controller
 * 
 * @package App\Controller
 * 
 * @access public
 * 
 * @author PACMS <pa.cms.test@gmail.com>
 */
class User
{
    /**
     * Login page
     *
     * @return void
     */
    public function login(): void
    {
        if (!empty($_SESSION["user"])) {
            if ($_SESSION["user"]["role"] != "user") {
                header("Location: /dashboard");
            }
        }
        $user = new UserModel();

        // if (!empty($_POST)) {
        //     Verificator::checkForm($user->getLoginForm(), $_POST + $_FILES);
        // }


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
        $view->assign('description', 'Page de connexion');
        $view->assign("user", $user);


        empty($_GET['error']) ?: $view->setFlashMessage('error', 'Identifiant ou mot de passe invalide');
    }

    /**
     * Register page
     *
     * @return void
     */
    public function register():void
    {
        if (!empty($_SESSION["user"])) {
            if ($_SESSION["user"]["role"] != "user") {
                header("Location: /dashboard");
            }
        }
        $user = new UserModel();
        $errors = null;
        if (!empty($_POST)) {
            $conditions = $_POST['acceptConditions'];
            unset($_POST['acceptConditions']);
            $_POST = array_map('htmlspecialchars', $_POST);
            $conditions[0] = htmlspecialchars($conditions[0]);
            $_POST["acceptConditions"] = $conditions;
            $errors = Verificator::checkForm($user->getCompleteRegisterForm(), $_POST + $_FILES);

            if (!$errors) {
                $user->hydrate($_POST);
                $user->setRole('user');
                $user->generateToken();
                $user->save();

                $mail = new Mail();
                $mail->sendConfirmMail($user);

                header('Location: /register/validate');
            }
        }

        $view = new View("register");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }

    public function notifyValidation()
    {
        $view = new View("notifyRegister", "front");
    }
    /**
     * Verify user token
     * 
     * @return void
     */
    public function verifyToken(): void
    {
        $user = new UserModel();
        $actualDateTime = new \DateTime();
        $date = new \DateTime($_GET["date"]);
        $interval = $actualDateTime->diff($date);
        $minutes = $interval->format('%i');

        if (isset($_GET["email"]) && isset($_GET["token"]) && $minutes < 10) {
            $user->verifyToken($_GET["email"], $_GET["token"]);
            header('Location: /login');
        } else {
            if (!isset($_GET["email"]) && !isset($_GET["token"])) {
                echo "L'email ou le token est null! Vérification impossible";
            } else {
                echo "Le lien n'est plus valide";
            }
        }
    }

    /**
     * Send token to user
     * 
     * @deprecated
     *
     * @return void
     */
    public function createToken(): void
    {

        $view = new View("token");
        //$view->assign("user", $user);
    }

    /**
     * Verify if user exists
     * 
     * @return void
     */
    public function loginVerify(): void
    {
        $user = new UserModel();
        $_POST = array_map('htmlspecialchars', $_POST);


        if (!empty($_POST)) {
            Verificator::checkForm(
                $user->getLoginForm(),
                $_POST + $_FILES
            );
        }
 
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        $params = ["email" => $_POST['email']];

        if ($user->verifyUser($params) == false) {
            header('Location: /login?error=login');
        }
    }

    /**
     * Google login
     * 
     * @return void
     */
    public function googleConnect(): void
    {
        $token = new OAuth($_GET['code']);
        $info = $token->google();
        $user = new UserModel();

        if (!$user->findOneBy(['email' => $info->email])) {
            $user->setFirstname($info->given_name);
            $user->setLastname($info->family_name);
            $user->setEmail($info->email);
            $user->setStatus(true);
            $user->setRole('user');
            $user->save();
        }
        
        $userInfos = $user->findOneBy(['email' => $info->email]);
        session_start();
        $_SESSION['user']['id'] = $userInfos['id'];
        $_SESSION['user']['email'] = $userInfos['email'];
        $_SESSION['user']['firstname'] = $userInfos['firstname'];
        $_SESSION['user']['lastname'] = $userInfos['lastname'];
        $_SESSION['user']['role'] = $userInfos['role'];

        switch($userInfos['role']) {
            case 'user':
                header('Location: /');
                break;
            case 'employee':
                header('Location: /dashboard');
                break;
            case 'admin':
                header('Location: /dashboard');
                break;
            default:
                header('Location: /');
        }  
    }

    /**
     * Facebook login
     * 
     * @return void
     */
    public function facebookConnect(): void
    {
        $token = new OAuth($_GET['code']);
        $info = $token->facebook();
        $user = new UserModel();

        if (!$user->findOneBy(['email' => $info->email])) {
            $user->setFirstname($info->first_name);
            $user->setLastname($info->last_name);
            $user->setEmail($info->email);
            $user->setStatus(true);
            $user->setRole('user');
            $user->save();
        }

        $userInfos = $user->findOneBy(['email' => $info->email]);
        session_start();
        $_SESSION['user']['id'] = $userInfos['id'];
        $_SESSION['user']['email'] = $userInfos['email'];
        $_SESSION['user']['firstname'] = $userInfos['firstname'];
        $_SESSION['user']['lastname'] = $userInfos['lastname'];
        $_SESSION['user']['role'] = $userInfos['role'];

        switch($userInfos['role']) {
            case 'user':
                header('Location: /');
                break;
            case 'employee':
                header('Location: /dashboard');
                break;
            case 'admin':
                header('Location: /dashboard');
                break;
            default:
                header('Location: /');
        }
    }

    /**
     * Lost password page
     * 
     * @return void
     */
    public function lostPassword(): void
    {
        $user = new UserModel();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($user->getLostPasswordForm(), $_POST);

            if (!$errors) {
                $_POST = array_map('htmlspecialchars', $_POST);
                $user->hydrate($_POST);

                if ((new MysqlBuilder())->select('user', ["*"])->where('email', $user->getEmail())->fetchClass('user')->fetch()) {
                    if (isset($_POST['withPassword']) && $_POST['withPassword'] == "true") $linkConnexion = "false";
                    else $linkConnexion = "true";

                    $user->generateToken();
                    $token = $user->getToken() . '&email=' . $user->getEmail() . '&date=' . (new \DateTime())->format("YmdHis") . '&tempLink=' . $linkConnexion;

                    (new MysqlBuilder())->update('user', ['token' => $token])->where('email', $user->getEmail())->execute();

                    $mail = new Mail();
                    $mail->lostPasswordMail($user, $token);
                }

                $view = new View("lostPassword", "front", 'success', 'Email envoyé', 'Un email va vous êtes envoyé, pensez à vérifier les spams !');
                $view->assign("title", "Mot de passe oublié");
                $view->assign("user", $user);
                $view->assign("errors", $errors);
            }
        }

        $view = new View("lostPassword");
        $view->assign("title", "Mot de passe oublié");
        $view->assign("user", $user);
        $view->assign("errors", $errors);
    }

    /**
     * Reset password page
     * 
     * @return void
     */
    public function resetPassword(): void
    {
        if (isset($_GET['tempLink']) && isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['token']) && !empty($_GET['token']) && isset($_GET['date']) && !empty($_GET['date']))
            if ((new MysqlBuilder())->select('user', ['*'])->where('email', htmlentities($_GET['email']))->fetchClass('user')->fetch()) {
                $user = (new MysqlBuilder())->select('user', ['*'])->where('email', htmlentities($_GET['email']))->fetchClass('user')->fetch();
                if (($_GET['token'] . '&email=' . $_GET['email'] . '&date=' . $_GET['date'] . '&tempLink=' . $_GET['tempLink']) == $user->getToken())
                    if (((new \DateTime())->diff(new \DateTime($_GET['date']))->format('%i')) < 60)
                        if ($_GET['tempLink'] == "true") {
                            $_SESSION['user']['id'] = $user->getId();
                            $_SESSION['user']['email'] = $user->getEmail();
                            $_SESSION['user']['firstname'] = $user->getFirstname();
                            $_SESSION['user']['lastname'] = $user->getLastname();
                            $_SESSION['user']['role'] = $user->getRole();

                            if ($user->getRole() == 'user') {
                                if (!is_null($_SESSION['previous_location'])) header('Location: ' . $_SESSION['previous_location']);
                                else header('Location: /');
                            } else header('Location: dashboard');
                        } else {
                            $errors = null;

                            if (!empty($_POST)) {
                                $errors = Verificator::checkForm($user->getResetPasswordForm(), $_POST);

                                if (!$errors) {
                                    $_POST = array_map('htmlspecialchars', $_POST);
                                    $user->hydrate($_POST);

                                    (new MysqlBuilder())->update('user', ['password' => $user->getPassword()])->where('email', $user->getEmail())->execute();

                                    new View("login", "front", 'success', 'Mot de passe changé', 'Votre mot de passe a bien été changé, vous pouvez maintenant vous connecter !');
                                }
                            }

                            $view = new View("resetPassword");
                            $view->assign("title", "Réinitialisation du mot de passe");
                            $view->assign("user", $user);
                            $view->assign("errors", $errors);
                        }
            }

    }

    /**
     * Logout action
     * 
     * @return void
     */
    public function logout()
    {
        $auth = new Auth();
        $logger = new LoggerObserver();

        $auth->attach($logger);
        $auth->logoutEvent();

        session_start();
        unset($_SESSION);

        session_destroy();
        header('Location: /login');
    }

}
