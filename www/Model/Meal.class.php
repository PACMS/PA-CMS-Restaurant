<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class Meal extends Sql
{
    protected $id = null;
    protected $name = null;
    protected $price = null;
    protected $description = null;
    protected $id_carte = null;
    protected $id_categories = null;

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
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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

    /**
     * @return int
     */
    public function getIdCategorie(): int
    {
        return $this->id_categories;
    }

    /**
     * @param int $id_categories
     */
    public function setIdCategorie(int $id_categories): void
    {
        $this->id_categories = $id_categories;
    }

   

     

    public function save(): void
    {
        parent::save();
    }

    public function getAllMeals(int $id)
    {
        $meals = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "meal", ['id_carte' => $id]);
        return $meals;
    }

    public function deleteMeal(int $id)
    {
        $meal = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "meal WHERE id = :id", ['id' => $id]);
        return $meal;
    }

    public function deleteMeals(int $id)
    {
        $meal = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "meal", ['id' => $id]);
        return $meal;
    }

    public function getAddMeal(array $categories = [], array $food = []): array
    {
        $options = [];
        foreach ($categories as $key => $value) {
            if ($value["id_carte"] == $_SESSION["id_card"]) {
                $options[$value["id"]] = ($value["name"]);
            }
        }
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/carte/meals/addMeal",
                "class" => "flex",
                "id" => "addMeal",
                "submit" => "Ajouter",
                'captcha' => false
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "label" => "Nom du menu",
                    "required" => true,
                ],
                "price" => [
                    "type" => "text",
                    "label" => "Prix",
                    "required" => true,
                    "error" => "Votre prix ne peut pas contenir de caractères",
                ],
                "description" => [
                    "type" => "textarea",
                    "maxlength" => 200,
                    "id" => "mealDescription",
                    "label" => "Description",
                    ],
                "id_carte" => [
                    "type" => "hidden",
                    "value" => intval($_SESSION["id_card"]),
                    "label" => "Description",
                    "required" => true
                ],
                "id_categories" => [
                    "type" => "select",
                    "label" => "Catégorie",
                    "placeholder" => "Choisissez une catégorie",
                    "default" => null,
                    "multiple" => false,
                    "options" => $options,
                    "required" => true
                ],
                "ingredients" => [
                    "type" => "select",
                    "label" => "Ingrédients",
                    "id" => "ingredients",
                    "placeholder" => "Choisissez un/plusieurs ingrédient(s)",
                    "default" => null,
                    "multiple" => true,
                    "options" => $food,
                    "required" => false
                ],
            ]
        ];
    }
   
}
