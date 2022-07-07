<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class Categorie extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $id_carte = null;

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
    public function getIdCarte(): string
    {
        return $this->id_carte;
    }

    /**
     * @param int $id_carte
     */
    public function setIdCarte(int $id_carte): void
    {
        $this->id_carte = $id_carte;
    }

    public function save(): void
    {
        parent::save();
    }

    public function getAllCategories()
    {
        $categories = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "categorie", []);
        return $categories;
    }

    public function deleteCategorie(int $id)
    {
        $carte = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "categorie WHERE id = :id", ['id' => $id]);
        return $carte;
    }

    
    public function getAddCategorie(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/carte/meals/addCategorie",
                "class" => "flex",
                "id" => "addCategorie",
                "submit" => "Ajouter",
                'captcha' => false
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "label" => "Nom de la catégorie",
                    "required" => true
                ],
                "IdCarte" => [
                    "type" => "hidden",
                    "value" => $_SESSION["id_card"],
                    "label" => "Description"
                ],
            ]
        ];
    }

    public function getUpdateCategorie($valueToChange = "", $idCategorie = ""): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/carte/meals/updateCategorie",
                "class" => "flex justify-content-between hidden",
                "id" => "",
                "submit" => "Modifier",
                'captcha' => false
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "value" => $valueToChange,
                    "required" => true
                ],
                "id" => [
                    "type" => "hidden",
                    "value" => $idCategorie,
                ],
            ]
        ];
    }
   
}
