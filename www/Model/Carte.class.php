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
        return $this->name;
    }

    /**
     * @param string $name
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
    public function getIdRestaurant(): int
    {
        return $this->id_restaurant;
    }

    /**
     * @param mixed $id_restaurant
     */
    public function setIdRestaurant(int $id_restaurant): void
    {
        $this->id_restaurant = $id_restaurant;
    }

    public function save(): void
    {
        parent::save();
    }

    public function getAllCartes()
    {
        // session_start();
        $cartes = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "carte WHERE id_restaurant = :id_restaurant", ['id_restaurant' => $_SESSION["id_restaurant"]]);
        return $cartes;
    }

    public function getOneCarte(string $id)
    {
        $carte = parent::databaseFindOne(['id' => intval($id)], "carte");
        return $carte;
    }

    public function deleteCarte(int $id)
    {
        $carte = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "carte WHERE id = :id", ['id' => $id]);
        return $carte;
    }

    public function getUpdateForm(array $carte): array
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
                "id" => [
                    "type" => "hidden",
                    "value" => $carte["id"],
                    "error" => "Le nom de la carte n'est pas correct !"
                ],
                "name" => [
                    "label" => "Nom",
                    "type" => "text",
                    "value" => $carte['name'],                   
                    "error" => "Le nom de la carte n'est pas correct !"
                ],
                "status" => [
                    "type" => "checkbox",
                    "additionnalDiv" => false,
                    "checked" => $carte["status"],
                    "required" => false,
                    "values" => [
                        "status" => "Status",
                    ],
                    "error" => "Le nom de la carte n'est pas correct !"
                ],
                "idRestaurant" => [
                    "type" => "hidden",
                    "value" => $carte["id_restaurant"],
                    "error" => "Le nom de la carte n'est pas correct !"
                ],
            ]
        ];
    }

    public function getCreateForm(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/updateCarte",
                "class" => "createCarte",
                "id" => "createCarte",
                "submit" => "Créer",
                'captcha' => false
            ],
            "inputs" => [
                "name" => [
                    "label" => "Nom",
                    "type" => "text",
                    "error" => "Le nom de la carte n'est pas correct !"
                ],
                "status" => [
                    "type" => "checkbox",
                    "additionnalDiv" => false,
                    "checked" => false,
                    "required" => false,
                    "values" => [
                        "status" => "Status",
                    ],
                    "error" => "Le nom de la carte n'est pas correct !"
                ],
                "idRestaurant" => [
                    "type" => "hidden",
                    "value" => $_SESSION["id_restaurant"],
                    "error" => "Le nom de la carte n'est pas correct !"
                ],
            ]
        ];
    }

    public function getDeleteForm(int $id): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/carte/delete",
                "submit" => "Supprimer",
                'captcha' => false
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "value" => $id,
                ],
            ]
        ];
    }
   
}
