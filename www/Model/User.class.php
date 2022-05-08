<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $status;
    protected $password;
    protected $token = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = (new Cleaner($firstname))->ucw()->e()->value;
    }

    /**
     * @return null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = (new Cleaner($lastname))->upper()->e()->value;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email): void
    {
        $this->email = (new Cleaner($email))->lower()->e()->value;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param null
     */
    public function generateToken(): void
    {
        $bytes = random_bytes(128);
        $this->token = substr(str_shuffle(bin2hex($bytes)), 0, 255);
    }


    public function save(): void
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        parent::save();
    }

    public function verifyToken(?string $email, ?string $tokenToVerify, ?bool $updateStatus = true): void
    {
        parent::accessToken($email, $tokenToVerify, $updateStatus);
    }

    public function retrieveToken(?string $email)
    {
        $retrieveToken = parent::databaseFindOne(['email' => $email]);
        return $retrieveToken['token'];
    }

    public function getIdWithEmail(?string $email)
    {
        $id = parent::databaseFindOne(['email' => $email]);
        return $id['id'];
    }

    public function getUser(array $id) 
    {
        return parent::databaseFindOne($id);
    }

    public function verifyUser(array $params): void
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        parent::verifyUser($params);
    }

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
    public function getLostPasswordForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "lostPasswordAction",
                "class" => "formLostPassword",
                "id" => "formLostPassword",
                "submit" => "Envoyer",
                'captcha' => false,
            ],
            "inputs" => [
                "email" => [
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailLogin",
                    "class" => "formLostPassword",
                    "required" => true,
                    "error" => "Votre combinaison mail/mot de passe n'est pas correct",
                ],
                // "captcha" => [
                //     'type' => 'captcha',
                //     'error' => 'Le captcha n\'a pas pu valider votre formulaire'
                // ]
            ]
        ];
    }

    public function getResetPasswordForm(): array
    {
        $action = "resetPasswordAction?email=" . $_GET['email'];
        return [
            "config" => [
                "method" => "POST",
                "action" => $action,
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
                    "error" => "Votre confirmation doit ne correspond pas",
                    "confirm" => "password"
                ]
            ]
        ];
    }
}
