<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class Reservation extends Sql
{

    protected $id = null;
    protected $name;
    protected $email;
    protected $date;
    protected $hour;
    protected $numPerson;
    protected $numTable;
    protected $phoneReserv;
    protected $status;
    protected $id_restaurant;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

   

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getNumPerson()
    {
        return $this->numPerson;
    }

    /**
     * @param mixed $numPerson
     */
    public function setNumPerson($numPerson): void
    {
        $this->numPerson = $numPerson;
    }

    /**
     * @return mixed
     */
    public function getNumTable()
    {
        return $this->numTable;
    }

    /**
     * @param mixed $numTable
     */
    public function setNumTable($numTable): void
    {
        $this->numTable = $numTable;
    }

    /**
     * @return mixed
     */
    public function getPhoneReserv()
    {
        return $this->phoneReserv;
    }

    /**
     * @param mixed $phoneReserv
     */
    public function setPhoneReserv($phoneReserv): void
    {
        $this->phoneReserv = (new Cleaner($phoneReserv))->value;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }


     /**
     * @return mixed
     */
    public function getIdRestaurant()
    {
        return $this->id_restaurant;
    }

    /**
     * @param mixed $id_restaurant
     */
    public function setIdRestaurant($id_restaurant): void
    {
        $this->id_restaurant = $id_restaurant;
    }



    public function save(): void
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        parent::save();
    }
    public function getAll(): array
    {
        return parent::getAll();
    }
    public function getAllReservationsFromRestaurant($params)
    {
        $reservations = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "reservation" , $params);
        return $reservations;
    }
    public function databaseDeleteOneReservation(array $params)
    {
        $reservations = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "reservation" . " WHERE id = :id", $params);
        return $reservations;
    }
    // $param à mettre en param et à la fin de la fonction
    public function getAllReservation(): array
    {
        return parent::databaseFindAll("SELECT * FROM " . DBPREFIXE .  "reservation WHERE date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 15 DAY)");  
    }

    public function EndForMailReservation(int $id = null) {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"/restaurant/completeReservation",
                "id"=>"formReservation",
                "submit"=>"Terminer",
                'captcha' => false,
            ],
            "inputs"=>[
                "id"=>[
                    "type"=>"hidden",
                    "value"=>$id,
                ],
            ]
        ];
    }

    public function getModalForm()
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"addReservation",
                "class"=>"containerForm flex flex-column",
                "id"=>"formReservation",
                "submit"=>"Ajouter",
                'captcha' => false,
            ],
            "inputs"=>[
                "name"=>[
                    "label"=>"Nom et prénom",
                    "type"=>"text",
                    "class"=>"formReservation",
                    "required" => true
                ],
                "email" => [
                    "label"=>"Adresse mail",
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailReservation",
                    "class" => "formReservation",
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                ],
                "numPerson"=>[
                    "label"=>"Nombre de personne",
                    "type"=>"number",
                    "class"=>"formReservation",
                    "min" => 1,
                    "minlength" => 1,
                    "max"=>10,
                    "maxlength"=>10,
                    "required" => true
                ],

                "numTable"=>[
                    "label"=>"Numero de table",
                    "type"=>"number",
                    "class"=>"formReservation",
                    "max"=>20,
                    "maxlength"=>20,
                ],
                "date"=>[
                    "label"=>"Date de reservation",
                    "type"=>"date",
                    "class"=>"formReservation",
                    "min"=>date('Y-m-d'),
                    "max"=>date('Y-m-d', strtotime('+1 year')),
                    "required" => true
                ],
                "hour"=>[
                    "label"=>"Heure de reservation",
                    "type"=>"time",
                    "class"=>"formReservation",
                    "required" => true
                ],
                "phoneReserv"=>[
                    "label"=>"Numéro de téléphone",
                    "type"=>"tel",
                    "class"=>"formRestaurant",
                    "min"=>10,
                    "minlength"=>10,
                    "max"=>10,
                    "maxlength"=>10,
                    "required" => true
                ],
            ]
        ];
    }
    public function getClientModalForm()
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"addReservationClient",
                "class"=>"containerForm flex flex-column",
                "id"=>"formReservation",
                "submit"=>"Ajouter",
                'captcha' => false,
            ],
            "inputs"=>[
                "name"=>[
                    "label"=>"Nom et prénom",
                    "type"=>"text",
                    "class"=>"formReservation",
                ],
                "email" => [
                    "label"=>"Adresse mail",
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailReservation",
                    "class" => "formReservation",
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                ],
                "numPerson"=>[
                    "label"=>"Nombre de personne",
                    "type"=>"number",
                    "class"=>"formReservation",
                    "min"=>1,
                    "minlength"=>1,
                    "max"=>10,
                    "maxlength"=>10,
                ],

                "numTable"=>[
                    "label"=>"Numero de table",
                    "type"=>"number",
                    "class"=>"formReservation",
                    "max"=>20,
                    "maxlength"=>20,
                ],
                "date"=>[
                    "label"=>"Date de reservation",
                    "type"=>"date",
                    "class"=>"formReservation",
                    "min"=>date('Y-m-d'),
                    "max"=>date('Y-m-d', strtotime('+1 year')),
                ],
                "hour"=>[
                    "label"=>"Heure de reservation",
                    "type"=>"time",
                    "class"=>"formReservation",

                ],
                "phoneReserv"=>[
                    "label"=>"Numéro de téléphone",
                    "type"=>"tel",
                    "class"=>"formRestaurant",
                    "min"=>4,
                    "minlength"=>4,
                    "max"=>15,
                    "maxlength"=>15,
                ],
                
            ]
        ];
    }

    public function getTableReservationForm ()
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"reserver-une-table/add",
                "class"=>"containerForm flex flex-column w-full",
                "id"=>"formReservation",
                "submit"=>"Ajouter",
                'captcha' => true,
            ],
            "inputs"=>[
                "name"=>[
                    "label"=>"Nom et prénom",
                    "type"=>"text",
                    "class"=>"formReservation",
                    "value" => $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] ?? ''
                ],
                "email" => [
                    "label"=>"Adresse mail",
                    "placeholder" => "Votre email ...",
                    "type" => "email",
                    "id" => "emailReservation",
                    "class" => "formReservation",
                    "required" => true,
                    "error" => "Votre email n'est pas correct",
                    "value" => $_SESSION['user']['email'] ?? ''
                ],
                "numPerson"=>[
                    "label"=>"Nombre de personne",
                    "type"=>"number",
                    "class"=>"formReservation",
                    "max"=>20,
                ],

                "numTable"=>[
                    "label"=>"Numero de table",
                    "type"=>"number",
                    "class"=>"formReservation",
                    "max"=>20,
                ],
                "date"=>[
                    "label"=>"Date de reservation",
                    "type"=>"date",
                    "class"=>"formReservation",
                    "min"=>date('Y-m-d'),
                    "max"=>date('Y-m-d', strtotime('+1 year')),
                ],
                "hour"=>[
                    "label"=>"Heure de reservation",
                    "type"=>"time",
                    "class"=>"formReservation",

                ],
                "phoneReserv"=>[
                    "label"=>"Numéro de téléphone",
                    "type"=>"tel",
                    "class"=>"formRestaurant",
                    "min"=>10,
                    "max"=>10,
                ],
            ],
            "captcha" => [
                'type' => 'captcha',
                'error' => 'Le captcha n\'a pas pu validé votre formulaire'
            ]
        ];
    }
}