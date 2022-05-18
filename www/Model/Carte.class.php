<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class Carte extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $status = null;
    protected $id_restaurant;

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
    public function getName(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setName(string $name): void
    {
        $this->name = (new Cleaner($name))->ucw()->e()->value;
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

    public function save(): void
    {
        //Pré traitement par exemple
        //echo "pre traitement";
        parent::save();
    }

    public function getAllCartes()
    {
        $cartes = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE."carte", []);
        return $cartes;
    }

    public function getOneCarte(string $id)
    {
        $carte = parent::databaseFindOne(['id' => intval($id)], "carte");
        return $carte;
    }

    public function getUpdateForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "updateCarte",
                "class" => "updateCarte",
                "id" => "updateCarte",
                "submit" => "Modifier",
                'captcha' => false
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "value" => "jsp",
                ]
            ]
        ];
    }
   
}
