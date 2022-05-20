<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class Categorie extends Sql
{
    protected $id = null;
    protected $name = null;

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

    public function save(): void
    {
        parent::save();
    }

    public function getAllCategories()
    {
        $categories = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "categorie", []);
        return $categories;
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

    
    public function getAddCategorie(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/carte/meals/addCategorie",
                "class" => "flex",
                "id" => "addCategorie",
                "submit" => "Ajouter",
                'captcha' => false
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "label" => "Nom de la catégorie"
                ],
            ]
        ];
    }
   
}
