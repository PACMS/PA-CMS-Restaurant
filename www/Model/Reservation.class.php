<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class Reservation extends Sql
{

    protected $id = null;
    protected $name;
    protected $date;
    protected $hour;
    protected $numPerson;
    protected $numTable;
    protected $phoneReserv;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
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

    public function getModalForm() {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"addReservation",
                "class"=>"containerForm",
                "id"=>"formReservation",
                "submit"=>"Ajouter",
                'captcha' => false,
            ],
            "inputs"=>[
                "name"=>[
                    "label"=>"Nom et prénom",
                    "placeholder"=>"",
                    "type"=>"text",
                    "id"=>"",
                    "class"=>"formReservation",
                ],
                "numPerson"=>[
                    "label"=>"Nombre de personne",
                    "placeholder"=>"",
                    "type"=>"number",
                    "id"=>"",
                    "class"=>"formReservation",
                    "max"=>20,
                ],

                "numTable"=>[
                    "label"=>"Numero de table",
                    "placeholder"=>"",
                    "type"=>"number",
                    "id"=>"",
                    "class"=>"formReservation",
                    "max"=>20,
                ],
                "date"=>[
                    "label"=>"Date de reservation",
                    "placeholder"=>"",
                    "type"=>"date",
                    "id"=>"",
                    "class"=>"formReservation",
                    "min"=>date('Y-m-d'),
                    "max"=>date('Y-m-d', strtotime('+1 year')),
                ],
                "hour"=>[
                    "label"=>"Heure de reservation",
                    "placeholder"=>"",
                    "type"=>"time",
                    "id"=>"",
                    "class"=>"formReservation",

                ],
                "phoneReserv"=>[
                    "label"=>"Numéro de téléphone",
                    "placeholder"=>"",
                    "type"=>"tel",
                    "id"=>"",
                    "class"=>"formRestaurant",
                    "min"=>10,
                    "max"=>10,

                ],
            ]
        ];
    }
}