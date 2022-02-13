<?php
namespace App\Model;

use App\Core\Sql;

class User extends Sql
{
    protected $id = null;
    protected $firstname = null;
    protected $lastname = null;
    protected $email;
    protected $status = 0;
    protected $password;
    protected $token = null;

    public function __construct()
    {
        // echo "constructeur du Model User";
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
     * @return null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param null $lastname
     */
    public function setLastname(?string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
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
        $this->email = strtolower(trim($email));
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

    public function verifyUser(array $params): void
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        parent::verifyUser($params);
    }

    public function getRegisterForm():array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"formRegister",
                "id"=>"formRegister",
                "submit"=>"S'inscrire",
                'captcha' => false,
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre email n'est pas correct",
                    "unicity"=>true,
                    "errorUnicity"=>"Un comte existe déjà avec cet email"
                ],
                "password"=>[
                    "placeholder"=>"Votre mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm"=>[
                    "placeholder"=>"Confirmation ...",
                    "type"=>"password",
                    "id"=>"pwdConfirmRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre confirmation doit ne correspond pas",
                    "confirm"=>"password"
                ],
                "firstname"=>[
                    "placeholder"=>"Votre prénom ...",
                    "type"=>"text",
                    "id"=>"firstnameRegister",
                    "class"=>"formRegister",
                    "min"=>2,
                    "max"=>25,
                    "error"=>"Votre prénom doit faire entre 2 et 25 caractères"
                ],
                "lastname"=>[
                    "placeholder"=>"Votre nom ...",
                    "type"=>"text",
                    "id"=>"lastnameRegister",
                    "class"=>"formRegister",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Votre nom doit faire entre 2 et 100 caractères"
                ],
                
            ]
        ];
    }

    public function getCompleteRegisterForm():array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"formRegister",
                "id"=>"formRegister",
                "submit"=>"S'inscrire",
                'captcha' => true,
                'file' => 'enctype="multipart/form-data"'
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre email n'est pas correct",
                    "unicity"=>true,
                    "errorUnicity"=>"Un comte existe déjà avec cet email"
                ],
                "password"=>[
                    "placeholder"=>"Votre mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre"
                ],
                "passwordConfirm"=>[
                    "placeholder"=>"Confirmation ...",
                    "type"=>"password",
                    "id"=>"pwdConfirmRegister",
                    "class"=>"formRegister",
                    "required"=>true,
                    "error"=>"Votre confirmation doit ne correspond pas",
                    "confirm"=>"password"
                ],
                "firstname"=>[
                    "placeholder"=>"Votre prénom ...",
                    "type"=>"text",
                    "id"=>"firstnameRegister",
                    "class"=>"formRegister",
                    "min"=>2,
                    "max"=>25,
                    "error"=>"Votre prénom doit faire entre 2 et 25 caractères"
                ],
                "lastname"=>[
                    "placeholder"=>"Votre nom ...",
                    "type"=>"text",
                    "id"=>"lastnameRegister",
                    "class"=>"formRegister",
                    "min"=>2,
                    "max"=>100,
                    "error"=>"Votre nom doit faire entre 2 et 100 caractères"
                ],
                "gender"=>[
                    "type"=>"radio",
                    "class"=>"formRegister",
                    "required"=>true,
                    "title"=>"Veuillez sélectionner les options suivantes:",
                    "checked"=>"F",
                    "values" => [
                        "F"=> "Femme",
                        "H"=> "Homme"
                    ],
                    "error"=>"Vous devez sélectionner une option"
                ],
                "checkLanguage"=>[
                    "type"=>"checkbox",
                    "class"=>"formRegister",
                    "title"=>"Veuillez sélectionner les options qui vous correspondent:",
                    "checked"=>"PHP",
                    "values"=>[
                        "JS"=>"JavaScript",
                        "PHP"=>"PHP",
                        "VB"=>"Visual Basic"
                    ],
                    "error"=>"Vous devez sélectionner un choix"
                ],
                "language"=>[
                    "type"=>"select",
                    "name"=>"language",
                    "class"=>"formRegister",
                    "label"=>"Choisissez un language de programmation:",
                    "placeholder"=>"Choisissez...",
                    "default"=>"PHP",
                    "options"=>[
                        "JS"=>"JavaScript",
                        "PHP"=>"PHP",
                        "VB"=>"Visual Basic",
                        "TS"=>"TypeScript",
                        "SQL"=>"SQL"
                    ],
                    "error"=>"Vous devez sélectionner une valeur dans la liste"
                ],
                "comment"=>[
                    "type"=>"textarea",
                    "id"=>"comment",
                    "class"=>"formRegister",
                    "label"=>"Commentaires :",
                    "max"=>240,
                    "placeholder"=>"Votre commentaire...",
                    "error"=>"Votre commentaire ne doit dépasser 240 caractères"
                ],
                "upload"=>[
                    "type"=>"file",
                    "id"=>"upload",
                    "class"=>"formRegister",
                    "label"=>"Choisissez un ficher:",
                    "accept"=>[
                        "png"=>"image/png",
                        "jpeg"=>"image/jpeg",
                        "jpg"=>"image/jpg"
                    ],
                    "error"=>"Vous ne pouvez uploader que des images de types png ou jpeg"
                ],
                "captcha" => [
                    'type' => 'captcha',
                    'error' => 'Le captcha n\'a pas pu valider votre formulaire'
                ]
            ]
        ];
    }

    public function getLoginForm():array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"loginVerify",
                "class"=>"formLogin",
                "id"=>"formLogin",  
                "submit"=>"Se connecter",
                'captcha' => false,
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailLogin",
                    "class"=>"formLogin",
                    "required"=>true,
                    "error"=>"Votre combinaison mail/mot de passe n'est pas correct",
                ],
                "password"=>[
                    "placeholder"=>"Votre mot de passe ...",
                    "type"=>"password",
                    "id"=>"pwdLogin",
                    "class"=>"formLogin",
                    "required"=>true,
                    "error"=>"Votre combinaison mail/mot de passe n'est pas correct"
                ],
                // "captcha" => [
                //     'type' => 'captcha',
                //     'error' => 'Le captcha n\'a pas pu valider votre formulaire'
                // ]
            ]
        ];
    }
    public function getLostPasswordForm():array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"lostPasswordAction",
                "class"=>"formLostPassword",
                "id"=>"formLostPassword",  
                "submit"=>"Envoyer",
                'captcha' => false,
            ],
            "inputs"=>[
                "email"=>[
                    "placeholder"=>"Votre email ...",
                    "type"=>"email",
                    "id"=>"emailLogin",
                    "class"=>"formLostPassword",
                    "required"=>true,
                    "error"=>"Votre combinaison mail/mot de passe n'est pas correct",
                ],
                // "captcha" => [
                //     'type' => 'captcha',
                //     'error' => 'Le captcha n\'a pas pu valider votre formulaire'
                // ]
            ]
        ];
    }

}