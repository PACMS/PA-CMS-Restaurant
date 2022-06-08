<?php

namespace App\Model;

use App\Core\Sql;
use App\Core\Cleaner;

/**
 *
 */
class Stock extends Sql
{
    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var
     */
    protected $restaurantId;
    

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

    // getter and setter for name    
    /**
     * @return mixed
     */
    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    /**
     * @param mixed $restaurantId
     */
    public function setRestaurantId(int $restaurantId): void
    {
        $this->restaurantId = $restaurantId;
    }


    


    public function getAllStocks(array $params)
    {
        $stocks = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "stock", $params);
        var_dump($stocks);
        return $stocks;
    }

    // public function databaseDeleteOneRestaurant(string $table, int $id)
    // {
    //     $restaurant = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . $table . " WHERE id = :id", ['id' => $id]);
    //     var_dump($restaurant);
    //     return $restaurant;
    // }

    public function getOneStock(string $table, array $params)
    {
        $stock = parent::databaseFindOne($params, $table);
        return $stock;
    }

    // public function getCompleteRestaurantForm()
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
