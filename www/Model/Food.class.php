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
        $this->stockId = $stockId;
    }


    


    public function getAllFoods(array $params)
    {
        
        $foods = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "food", $params);
        return $foods;
    }

    public function databaseDeleteOneFood(string $table, int $id)
    {
        $food = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . $table . " WHERE id = :id", ['id' => $id]);
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
                    "value" => $this->quantity,
                    "error" => "Le champs quantité contient une erreur"
                ],
                "stockId" => [
                    "type" => "hidden",
                    "value" => $_SESSION["id_stock"],
                    "label" => "StockId",
                ],
                // "captcha" => [
                //     'type' => 'captcha',
                //     'error' => 'Le captcha n\'a pas pu validé votre formulaire'
                // ]
            ]
        ];
    }
    // public function getCompleteUpdateRestaurantForm()
    // {
    //     return [
    //         "config" => [
    //             "method" => "POST",
    //             "action" => "/restaurant/creation",
    //             "class" => "formRestaurant",
    //             "id" => "formRestaurant",
    //             "submit" => "Ajouter le restaurant",
    //             'captcha' => false,
    //         ],
    //         "inputs" => [
    //             "id" => [
    //                 "type" => "hidden",
    //                 "id" => "id",
    //                 "class" => "formRestaurant",
    //                 "value" => intval($this->id),
    //             ],
    //             "name" => [
    //                 "placeholder" => "Nom du restaurant*",
    //                 "type" => "text",
    //                 "id" => "name",
    //                 "class" => "formRestaurant",
    //                 "required" => true,
    //                 "min" => 2,
    //                 "max" => 100,
    //                 "value" => $this->name,
    //                 "error" => "Le nom de votre restaurant n'est pas correct",
    //             ],
    //             "address" => [
    //                 "placeholder" => "Votre adresse*",
    //                 "type" => "text",
    //                 "id" => "address",
    //                 "class" => "formRestaurant",
    //                 "required" => true,
    //                 "min" => 2,
    //                 "max" => 255,
    //                 "value" => $this->address,
    //                 "error" => "Le champs adresse contient une erreur",
    //             ],
    //             "additional_address" => [
    //                 "placeholder" => "Complément d'adresse",
    //                 "type" => "text",
    //                 "id" => "additional_address",
    //                 "class" => "formRestaurant",
    //                 "max" => 255,
    //                 "value" => $this->additional_address,
    //                 "error" => "Le champs complément d'adresse contient une erreur"
    //             ],
    //             "city" => [
    //                 "placeholder" => "Ville*",
    //                 "type" => "text",
    //                 "id" => "city",
    //                 "class" => "formRestaurant",
    //                 "required" => true,
    //                 "min" => 2,
    //                 "max" => 50,
    //                 "value" => $this->city,
    //                 "error" => "Le nom de votre ville n'est pas correct",
    //             ],
    //             "zipcode" => [
    //                 "placeholder" => "Code postal*",
    //                 "type" => "number",
    //                 "id" => "zipcode",
    //                 "class" => "formRestaurant",
    //                 "required" => true,
    //                 "min" => 2,
    //                 "max" => 10,
    //                 "value" => $this->zipcode,
    //                 "error" => "Votre code postal est incorrect",
    //             ],
    //             "phone" => [
    //                 "placeholder" => "Téléphone*",
    //                 "type" => "number",
    //                 "id" => "phone",
    //                 "class" => "formRestaurant",
    //                 "required" => true,
    //                 "min" => 2,
    //                 "max" => 15,
    //                 "value" => $this->phone,
    //                 "error" => "Votre numéro de téléphone est incorrect",
    //             ],
    //             // "captcha" => [
    //             //     'type' => 'captcha',
    //             //     'error' => 'Le captcha n\'a pas pu validé votre formulaire'
    //             // ]
    //         ]
    //     ];
    // }
}
