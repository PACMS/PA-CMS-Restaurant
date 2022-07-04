<?php

namespace App\Model;

use App\Core\Sql;
use App\Core\Cleaner;

/**
 *
 */
class Food extends Sql
{
    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var
     */
    protected $name = null;
    /**
     * @var
     */
    protected $nature = null;
    /**
     * @var
     */
    protected $quantity = null;
    /**
     * @var
     */
    protected $stockId = null;


    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null
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
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * @param mixed $name
     */
    public function setNature(string $nature): void
    {
        $this->nature = $nature;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $name
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getStockId()
    {
        return $this->stockId;
    }

    /**
     * @param mixed $stockId
     */
    public function setStockId(int $stockId): void
    {
        $this->stockId = intval($stockId);
    }


    public function getOneFood(string $table, int $id)
    {
        $restaurant = parent::databaseFindOne(['id' => $id], $table);
        return $restaurant;
    }


    public function getAllFoods(array $params)
    {

        $foods = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "food", $params);
        return $foods;
    }

    public function deleteFood(int $id)
    {
        $food = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "food" . " WHERE id = :id " , ['id' => $id]);
        return $food;
    }

    // public function getOneRestaurant(string $table, int $id)
    // {
    //     $restaurant = parent::databaseFindOne(['id' => $id], $table);
    //     return $restaurant;
    // }

    public function getAddProduct()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/food/create",
                "class" => "flex",
                "id" => "addProduct",
                "submit" => "Ajouter le produit",
                'captcha' => false,
            ],
            "inputs" => [
                "name" => [
                    "placeholder" => "Nom du produit*",
                    "type" => "text",
                    "id" => "name",
                    "class" => "formRestaurant",
                    "required" => true,
                    "min" => 2,
                    "max" => 100,
                    "value" => $this->name,
                    "error" => "Le nom de votre produit n'est pas correct",
                ],
                "nature" => [
                    "placeholder" => "Nature*",
                    "type" => "text",
                    "id" => "nature",
                    "class" => "formRestaurant",
                    "required" => true,
                    "min" => 2,
                    "max" => 255,
                    "value" => $this->nature,
                    "error" => "Le champs adresse contient une erreur",
                ],
                "quantity" => [
                    "placeholder" => "Quantité*",
                    "type" => "text",
                    "id" => "quantity",
                    "class" => "formRestaurant",
                    "max" => 255,
                    "required" => true,
                    "value" => $this->quantity,
                    "error" => "Le champs quantité contient une erreur"
                ],
                "stockId" => [
                    "type" => "hidden",
                    "value" => $_SESSION["stock"]["id"],
                    "label" => "StockId",
                ],
            ]
        ];
    }
    public function editFoodInfo()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/food",
                "class" => "flex",
                "id" => "editProduct",
                "submit" => "Modifier",
                'captcha' => false,
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "formRestaurant",
                    "value" => intval($this->id),
                ],
            ]
        ];
    }
    public function updateFoodForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/food/update",
                "class" => "restaurant-form",
                "id" => "restaurant-form",
                "submit" => "Sauvegarder les modifications",
                'captcha' => false,
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "restaurant-inputs",
                    "value" => intval($this->id),
                ],
                "name" => [
                    "placeholder" => "Nom du produit*",
                    "type" => "text",
                    "id" => "name",
                    "class" => "restaurant-name",
                    "required" => true,
                    "min" => 2,
                    "max" => 100,
                    "value" => $this->name,
                    "error" => "Le nom de votre produit n'est pas correct",
                ],
                "nature" => [
                    "placeholder" => "Nature du produit*",
                    "type" => "text",
                    "id" => "nature",
                    "class" => "restaurant-inputs",
                    "required" => true,
                    "min" => 2,
                    "max" => 100,
                    "value" => $this->nature,
                    "error" => "La nature de votre produit n'est pas correct",
                ],
                "quantity" => [
                    "placeholder" => "Quantité*",
                    "type" => "text",
                    "id" => "quantity",
                    "required" => true,
                    "class" => "restaurant-inputs",
                    "max" => 255,
                    "value" => $this->quantity,
                    "error" => "Le champs quantité contient une erreur"
                ],
                "stockId" => [
                    "type" => "hidden",
                    "value" => $_SESSION["stock"]["id"],
                    "label" => "StockId",
                ],
            ]
        ];
    }
    
}
