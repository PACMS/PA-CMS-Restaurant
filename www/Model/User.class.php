<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\MysqlBuilder;
use App\Core\Sql;
use App\Enum\Role;

/**
 * User Model
 * 
 * @category Model
 * 
 * @package App\Model
 * 
 * @access public
 * 
 * @author PACMS <pa.cms.test@gmail.com>
 *
 */
class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $status;
    protected $role;
    protected $password;
    protected $lastPassword;

    /**
     * @return mixed
     */
    public function getLastPassword()
    {
        return $this->lastPassword;
    }

    /**
     * @param mixed $lastPassword
     */
    public function setLastPassword($lastPassword): void
    {
        $this->lastPassword = password_hash($lastPassword, PASSWORD_DEFAULT);
    }
    protected $token = null;

    /**
     * User constructor.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get Id of the user
     * 
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set Id of the user
     * 
     * @param int $id The id of the user
     * 
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * Get firstname of the user
     * 
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set firstname of the user
     * 
     * @param string $firstname The firstname of the user
     * 
     * @return void Return the firstname of the user without spaces and with the first letter of each word in uppercase
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = (new Cleaner($firstname))->ucw()->e()->value;
    }

    /**
     * Get lastname of the user
     * 
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set lastname of the user
     * 
     * @param string $lastname The lastname of the user
     * 
     * @return void Returns the lastname of the user without spaces and in uppercase
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = (new Cleaner($lastname))->upper()->e()->value;
    }

    /**
     * Get email of the user
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email of the user
     * 
     * @param string $email The email of the user
     * 
     * @return void Returns the email of the user without spaces and in lowercase
     */
    public function setEmail(string $email): void
    {
        $this->email = (new Cleaner($email))->lower()->e()->value;
    }

    /**
     * Get status of the user
     * 
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set status of the user
     * 
     * @param int $status The status of the user
     * 
     * @return void
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * Get password of the user
     * 
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password of the user
     * 
     * @param string $password The password of the user
     * 
     * @return void Return the password of the user with hash
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Get token of the user
     * 
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Get role of the user
     * 
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * Set role of the user
     * 
     * @param string $role Name of the role (admin, employee, user)
     * 
     * @return void
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Generate token for the user
     * 
     * @return void Return the token of the user
     */
    public function generateToken(): void
    {
        $bytes = random_bytes(128);
        $this->token = substr(str_shuffle(bin2hex($bytes)), 0, 255);
    }

    /**
     * Save an user
     *
     * @return void
     */
    public function save(): void
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        parent::save();
    }

    /**
     * Verify token of the user
     *
     * @param string|null $email         The email of the user
     * @param string|null $tokenToVerify The token to verify
     * @param bool|null   $updateStatus  If the status of the user must be updated 
     * 
     * @return void
     */
    public function verifyToken(?string $email, ?string $tokenToVerify, ?bool $updateStatus = true): void
    {
        parent::accessToken($email, $tokenToVerify, $updateStatus);
    }

    /**
     * Retrieve the token of the user
     *
     * @param string $email The email of the user
     * 
     * @return string|null Returns the token of the user or null if the user doesn't exist
     */
    public function retrieveToken(string $email): ?string
    {
        $retrieveToken = parent::databaseFindOne(['email' => $email]);
        return $retrieveToken['token'];
    }

    /**
     * Get Id of user with his email
     *
     * @param string $email Email of user
     * 
     * @return int|null Returns the id of the user or null if the user doesn't exist
     */
    public function getIdWithEmail(string $email): ?int
    {
        $userId = parent::databaseFindOne(['email' => $email]);
        return $userId['id'];
    }

    /**
     * Get the user by Id
     *
     * @param int $id The id of the user
     * 
     * @return array|null Returns the user or null if the user doesn't exist
     */
    public function getUserById(int $id): ?array
    {
        return parent::databaseFindOne(['id' => $id]);
    }

    public function getUser()
    {
        return (new MysqlBuilder())->select('user', ['*'])->where('email', $_SESSION['user']['email'])->fetchClass('user')->fetch();
    }

    public function verifyUser(array $params)
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        return parent::verifyUser($params);
    }

    /**
     * Get all users
     *
     * @return array Returns all users
     */
    public function getAll(): array
    {
        return parent::getAll();
    }

    /**
     * Delete an user in the database
     * 
     * @param int $id The id of the user to delete
     * 
     * @return void
     */
    public function deleteUser($id): void
    {
        parent::delete($id);
    }

    /**
     * Form for register an user
     *
     * @return array
     */
    public function getRegisterForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "formRegister",
                "id" => "formRegister",
                "submit" => "S'inscrire",
                'captcha' => false,
            ],
            "inputs" => [
                "email" => [
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                    "unicity" => true,
                    "errorUnicity" => "Un compte existe déjà avec cet email"
                ],
                "password" => [
                    "placeholder" => "Votre mot de passe ...",
                    "type" => "password",
                    "id" => "pwdRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm" => [
                    "placeholder" => "Confirmation ...",
                    "type" => "password",
                    "id" => "pwdConfirmRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre confirmation doit ne correspond pas",
                    "confirm" => "password"
                ],
                "firstname" => [
                    "placeholder" => "Votre prénom ...",
                    "type" => "text",
                    "id" => "firstnameRegister",
                    "class" => "formRegister",
                    "min" => 2,
                    "max" => 25,
                    "error" => "Votre prénom doit faire entre 2 et 25 caractères"
                ],
                "lastname" => [
                    "placeholder" => "Votre nom ...",
                    "type" => "text",
                    "id" => "lastnameRegister",
                    "class" => "formRegister",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom doit faire entre 2 et 100 caractères"
                ],

            ]
        ];
    }

    /**
     * Form for register an user
     *
     * @return array
     */
    public function getCompleteRegisterForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "formRegister",
                "id" => "formRegister",
                "submit" => "Inscription",
                'captcha' => true,
            ],
            "inputs" => [
                "lastname" => [
                    "label" => "Nom",
                    "type" => "text",
                    "id" => "lastnameRegister",
                    "class" => "formRegister",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom doit faire entre 2 et 100 caractères"
                ],
                "firstname" => [
                    "label" => "Prénom",
                    "type" => "text",
                    "id" => "firstnameRegister",
                    "class" => "formRegister",
                    "min" => 2,
                    "max" => 25,
                    "error" => "Votre prénom doit faire entre 2 et 25 caractères"
                ],
                "email" => [
                    "label" => "Adresse mail",
                    "type" => "email",
                    "id" => "emailRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                    "unicity" => 'user',
                    "errorUnicity" => "Un comte existe déjà avec cet email"
                ],
                "password" => [
                    "label" => "Mot de passe  <i id=\"info-password-register\" class=\"fal fa-info-circle\"></i>",
                    "type" => "password",
                    "id" => "pwdRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm" => [
                    "label" => "Confirmer mot de passe",
                    "type" => "password",
                    "id" => "pwdConfirmRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre confirmation doit ne correspond pas",
                    "confirm" => "password"
                ],
                "acceptConditions" => [
                    "title" => "",
                    "additionnalDiv" => true,
                    "type" => "checkbox",
                    "id" => "accept_conditions_register",
                    "class" => "formRegister",
                    "required" => true,
                    "checked" => false,
                    "error" => "Vous devez accepter les conditions d'utilisation",
                    "values" => [
                        "acceptConditions" => "En cliquant ici, vous acceptez <span>les CGU</span> du site",
                    ]
                ],
                "captcha" => [
                    'type' => 'captcha',
                    'error' => 'Le captcha n\'a pas pu valider votre formulaire'
                ]
            ]
        ];
    }

    /**
     * Form for register an user
     *
     * @return array
     */
    public function getAdminRegisterForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/setupAction",
                "class" => "formAdminRegister",
                "id" => "formAdminRegister",
                "submit" => "Créer",
                'captcha' => false,
            ],
            "inputs" => [
                "lastname" => [
                    "label" => "Nom",
                    "type" => "text",
                    "id" => "lastnameRegister",
                    "class" => "formRegister",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom doit faire entre 2 et 100 caractères"
                ],
                "firstname" => [
                    "label" => "Prénom",
                    "type" => "text",
                    "id" => "firstnameRegister",
                    "class" => "formRegister",
                    "min" => 2,
                    "max" => 25,
                    "error" => "Votre prénom doit faire entre 2 et 25 caractères"
                ],
                "email" => [
                    "label" => "Adresse mail",
                    "type" => "email",
                    "id" => "emailRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                    "unicity" => 'user',
                    "errorUnicity" => "Un comte existe déjà avec cet email"
                ],
                "password" => [
                    "label" => "Mot de passe  <i id=\"info-password-register\" class=\"fal fa-info-circle\"></i>",
                    "type" => "password",
                    "id" => "pwdRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm" => [
                    "label" => "Confirmer mot de passe",
                    "type" => "password",
                    "id" => "pwdConfirmRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre confirmation doit ne correspond pas",
                    "confirm" => "password"
                ],
                "acceptConditions" => [
                    "title" => "",
                    "additionnalDiv" => true,
                    "type" => "checkbox",
                    "id" => "accept_conditions_register",
                    "class" => "formRegister",
                    "required" => true,
                    "checked" => false,
                    "error" => "Vous devez accepter les conditions d'utilisation",
                    "values" => [
                        "acceptConditions" => "En cliquant ici, vous acceptez <span>les CGU</span> du site",
                    ]
                ]
            ]
        ];
    }

    /**
     * Form for login an user
     *
     * @return array
     */
    public function getLoginForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "loginVerify",
                "class" => "formLogin",
                "id" => "formLogin",
                "submit" => "Se connecter",
                'captcha' => false,
            ],
            "inputs" => [
                "email" => [
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailLogin",
                    "class" => "formLogin",
                    "required" => true,
                    "error" => "Votre combinaison mail/mot de passe n'est pas correct",
                ],
                "password" => [
                    "placeholder" => "Votre mot de passe ...",
                    "type" => "password",
                    "id" => "pwdLogin",
                    "class" => "formLogin",
                    "required" => true,
                    "error" => "Votre combinaison mail/mot de passe n'est pas correct"
                ],
                // "captcha" => [
                //     'type' => 'captcha',
                //     'error' => 'Le captcha n\'a pas pu valider votre formulaire'
                // ]
            ]
        ];
    }

    /**
     * Form for forgotten password
     * 
     * @return array
     */
    public function getLostPasswordForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "lostPassword",
                "class" => "formLostPassword",
                "id" => "formLostPassword",
                "submit" => "Envoyer",
                'captcha' => true,
            ],
            "inputs" => [
                "email" => [
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailLogin",
                    "class" => "formLostPassword",
                    "required" => true,
                    "error" => "Email non conforme",
                ],
                "withPassword" => [
                    "type" => "hidden",
                    "id" => "inputPasswordChoice",
                    "required" => true,
                    'value' => "false"
                ],
            ],
            "captcha" => [
                'type' => 'captcha',
                'error' => 'Le captcha n\'a pas pu valider votre formulaire'
            ]
        ];
    }

    /**
     * Form for reset password
     *
     * @return array
     */
    public function getResetPasswordForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => 'resetPassword?token=' . ($_GET['token'] . '&email=' . $_GET['email'] . '&date=' . $_GET['date'] . '&tempLink=' . $_GET['tempLink']),
                "class" => "formResetPassword",
                "id" => "formResetPassword",
                "submit" => "Envoyer",
                'captcha' => false,
            ],
            "inputs" => [
                "password" => [
                    "placeholder" => "Votre mot de passe ...",
                    "type" => "password",
                    "id" => "pwdRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm" => [
                    "placeholder" => "Confirmation ...",
                    "type" => "password",
                    "id" => "pwdConfirmRegister",
                    "class" => "formRegister",
                    "required" => true,
                    "error" => "Votre confirmation ne correspond pas",
                    "confirm" => "password"
                ]
            ]
        ];
    }

    public function getUserCreationForm()
    {
        $options = [];
        foreach (Role::cases() as $role)
            $options[$role->name] = $role->value;

        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"restaurant-form",
                "id"=>"",
                "submit"=>"Ajouter l'utilisateur",
                'captcha' => true,
            ],
            "inputs"=>[
                "firstname"=>[
                    "label"=>"Prénom",
                    "type"=>"text",
                    "id"=>"firstname",
                    "class"=>"inputProfile",
                    "required"=>true,
                    "min"=>2,
                    "max"=>255,
                    "error"=>"Le prénom n'est pas correct",
                ],
                "lastname"=>[
                    "label"=>"Nom",
                    "type"=>"text",
                    "id"=>"lastname",
                    "class"=>"inputProfile",
                    "min"=>2,
                    "max"=>255,
                    "error"=>"Le nom n'est pas correct"
                ],
                "email" => [
                    "label" => "Adresse mail",
                    "type" => "email",
                    "id" => "emailRegister",
                    "class" => "inputProfile",
                    "required" => true,
                    "min"=>2,
                    "max"=>255,
                    "error" => "Votre email n'est pas correct",
                    "unicity" => 'user',
                    "errorUnicity" => "Un comte existe déjà avec cet email"
                ],
                "password" => [
                    "label" => "Mot de passe",
                    "type" => "password",
                    "id" => "pwdRegister",
                    "class" => "inputProfile",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm" => [
                    "label" => "Confirmer mot de passe",
                    "type" => "password",
                    "id" => "pwdConfirmRegister",
                    "class" => "inputProfile",
                    "required" => true,
                    "error" => "Votre confirmation ne correspond pas",
                    "confirm" => "password"
                ],
                "role"=>[
                    "type"=>"select",
                    "name"=>"role",
                    "class"=>"inputProfile",
                    "id"=>"role",
                    "multiple"=>false,
                    "label"=>"Choisissez un role:",
                    "placeholder"=>"Choisissez...",
                    "default"=>"Utilisateur",
                    "options"=> $options,
                    "error"=>"Vous devez sélectionner une valeur dans la liste"
                ],
                "status"=>[
                    "type"=>"select",
                    "name"=>"status",
                    "class"=>"inputProfile",
                    "id"=>"status",
                    "multiple"=>false,
                    "label"=>"Choisissez un status:",
                    "placeholder"=>"Choisissez...",
                    "default"=>"Inactif",
                    "options"=>[
                        1 => "Actif",
                        -1 => "Inactif"
                    ],
                    "error"=>"Vous devez sélectionner une valeur dans la liste"
                ],
                "captcha" => [
                    'type' => 'captcha',
                    'error' => 'Le captcha n\'a pas pu validé votre formulaire'
                ]
            ]
        ];
    }


    public function getUpdateUserForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "restaurant-form",
                "id" => "formUpdateProfile",
                "submit" => "Confirmer",
                'captcha' => true,
            ],
            "inputs" => [
                "lastname" => [
                    "label" => "Nom",
                    "type" => "text",
                    "id" => "lastnameUpdateProfile",
                    "class" => "inputProfile disabled",
                    "value" => $this->getUser()->lastname,
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom doit faire entre 2 et 100 caractères",
                    "required" => true,
                    "disabled" => true
                ],
                "firstname" => [
                    "label" => "Prénom",
                    "type" => "text",
                    "id" => "firstnameUpdateProfile",
                    "class" => "inputProfile disabled",
                    "value" => $this->getUser()->firstname,
                    "min" => 2,
                    "max" => 25,
                    "error" => "Votre prénom doit faire entre 2 et 25 caractères",
                    "required" => true,
                    "disabled" => true
                ],
                "email" => [
                    "label" => "Adresse mail",
                    "type" => "email",
                    "id" => "emailUpdateProfile",
                    "class" => "inputProfile disabled",
                    "value" => $this->getUser()->email,
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                    "disabled" => true
                ],
                "lastPassword" => [
                    "placeholder" => 'Ancien mot de passe',
                    "type" => "password",
                    "id" => "lastPwdUpdateProfile",
                    "class" => "inputProfile hidden",
                    "required" => true,
                    "error" => "Votre ancien mot de passe ne correspond pas"
                ],
                "password" => [
                    "placeholder" => 'Mot de passe',
                    "type" => "password",
                    "id" => "pwdUpdateProfile",
                    "class" => "inputProfile hidden",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm" => [
                    "placeholder" => 'Confirmer mot de passe',
                    "type" => "password",
                    "id" => "pwdConfirmUpdateProfile",
                    "class" => "inputProfile hidden",
                    "required" => true,
                    "error" => "Votre confirmation doit ne correspond pas",
                    "confirm" => "password"
                ],
                "captcha" => [
                    'type' => 'captcha',
                    'error' => 'Le captcha n\'a pas pu valider votre formulaire'
                ]
            ]
        ];
    }


    public function getUpdateUsersForm(): array
    {
        $options = [];
        foreach (Role::cases() as $role)
            $options[$role->name] = $role->value;

        $user = (new MysqlBuilder())->select('user', ['*'])->where('id', $_SESSION['updateID'])->fetchClass('user')->fetch();

        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "restaurant-form",
                "id" => "formUpdateUsers",
                "submit" => "Mettre à jour",
                'captcha' => false,
            ],
            "inputs" => [
                "lastname" => [
                    "label" => "Nom",
                    "type" => "text",
                    "id" => "lastnameUpdateProfile",
                    "class" => "inputProfile",
                    "value" => $user->getLastname(),
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom doit faire entre 2 et 100 caractères",
                    "required" => true,
                ],
                "firstname" => [
                    "label" => "Prénom",
                    "type" => "text",
                    "id" => "firstnameUpdateProfile",
                    "class" => "inputProfile",
                    "value" => $user->getFirstname(),
                    "min" => 2,
                    "max" => 25,
                    "error" => "Votre prénom doit faire entre 2 et 25 caractères",
                    "required" => true,
                ],
                "email" => [
                    "label" => "Adresse mail",
                    "type" => "email",
                    "id" => "emailUpdateProfile",
                    "class" => "inputProfile",
                    "value" => $user->getEmail(),
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                ],
                "role" => [
                    "type" => "select",
                    "label" => "Rôle",
                    "placeholder" => "Choisissez un rôle",
                    "default" => $user->getRole(),
                    "multiple" => false,
                    "options" => $options,
                    "required" => true
                ],
                "status" => [
                    "type" => "select",
                    "label" => "Status",
                    "placeholder" => "Choisissez un status",
                    "default" => $user->getStatus(),
                    "multiple" => false,
                    "options" => [
                        -1 => 'Inactif',
                        true => 'Actif'
                    ],
                    "required" => true
                ]
            ]
        ];
    }
}
