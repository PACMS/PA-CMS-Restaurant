<?php

namespace App\Model;

use App\Core\Sql;
use App\Core\Cleaner;

/**
 *
 */
class Restaurant extends Sql
{
    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $address;
    /**
     * @var
     */
    protected $additional_address;
    /**
     * @var
     */
    protected $city;
    /**
     * @var
     */
    protected $zipcode;
    /**
     * @var
     */
    protected $phone;

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
    public function setId(int $id): void
    {
        $this->id = $id; 
    }

    // getter and setter for name	
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
        $this->name = (new Cleaner($name))->e()->value;
    }


    /**
     * @return mixed
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress(string $address): void
    {
        $this->address = (new Cleaner($address))->ucw()->e()->value;
    }

    /**
     * @return mixed
     */
    public function getAdditional_address(): string
    {
        return $this->additional_address;
    }

    /**
     * @param mixed $additional_address
     */
    public function setAdditional_address(string $additional_address): void
    {
        $this->additional_address = (new Cleaner($additional_address))->ucw()->e()->value;
    }

    /**
     * @return mixed
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity(string $city): void
    {
        $this->city = (new Cleaner($city))->upper()->e()->value;
    }

    /**
     * @return mixed
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode(string $zipcode): void
    {
        $this->zipcode = (new Cleaner($zipcode))->value;
    }

    /**
     * @return mixed
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = (new Cleaner($phone))->value;
    }


    public function getAllRestaurants()
    {
        $restaurants = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "restaurant", []);
        return $restaurants;
    }

    public function databaseDeleteOneRestaurant(string $table, int $id)
    {
        $restaurant = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . $table . " WHERE id = :id", ['id' => $id]);
        var_dump($restaurant);
        return $restaurant;
    }

    public function getOneRestaurant(string $table, int $id)
    {
        $restaurant = parent::databaseFindOne(['id' => $id], $table);
        return $restaurant;
    }

    public function getCompleteRestaurantForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "restaurant/create",
                "class" => "formRestaurant",
                "id" => "formRestaurant",
                "submit" => "Ajouter le restaurant",
                'captcha' => false,
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "formRestaurant",
                    "value" => 24,
                ],
                "name" => [
                    "placeholder" => "Nom du restaurant*",
                    "type" => "text",
                    "id" => "name",
                    "class" => "formRestaurant",
                    "required" => true,
                    "min" => 2,
                    "max" => 100,
                    "value" => $this->name,
                    "error" => "Le nom de votre restaurant n'est pas correct",
                ],
                "address" => [
                    "placeholder" => "Votre adresse*",
                    "type" => "text",
                    "id" => "address",
                    "class" => "formRestaurant",
                    "required" => true,
                    "min" => 2,
                    "max" => 255,
                    "value" => $this->address,
                    "error" => "Le champs adresse contient une erreur",
                ],
                "additional_address" => [
                    "placeholder" => "Complément d'adresse",
                    "type" => "text",
                    "id" => "additional_address",
                    "class" => "formRestaurant",
                    "max" => 255,
                    "value" => $this->additional_address,
                    "error" => "Le champs complément d'adresse contient une erreur"
                ],
                "city" => [
                    "placeholder" => "Ville*",
                    "type" => "text",
                    "id" => "city",
                    "class" => "formRestaurant",
                    "required" => true,
                    "min" => 2,
                    "max" => 50,
                    "value" => $this->city,
                    "error" => "Le nom de votre ville n'est pas correct",
                ],
                "zipcode" => [
                    "placeholder" => "Code postal*",
                    "type" => "number",
                    "id" => "zipcode",
                    "class" => "formRestaurant",
                    "required" => true,
                    "min" => 2,
                    "max" => 10,
                    "value" => $this->zipcode,
                    "error" => "Votre code postal est incorrect",
                ],
                "phone" => [
                    "placeholder" => "Téléphone*",
                    "type" => "number",
                    "id" => "phone",
                    "class" => "formRestaurant",
                    "required" => true,
                    "min" => 2,
                    "max" => 15,
                    "value" => $this->phone,
                    "error" => "Votre numéro de téléphone est incorrect",
                ],
                // "captcha" => [
                //     'type' => 'captcha',
                //     'error' => 'Le captcha n\'a pas pu validé votre formulaire'
                // ]
            ]
        ];
    }
}
