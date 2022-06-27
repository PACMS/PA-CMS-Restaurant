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
     * @var
     */
    protected $user_id;

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
        $this->id = intval($id);
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

    /**
     * @return mixed
     */
    public function getUser_id(): string
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUser_id(string $user_id): void
    {
        $this->user_id = intval($user_id);
    }


    public function getAllRestaurants(array $params = [])
    {
        $restaurants = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "restaurant", $params);
        return $restaurants;
    }

    public function databaseDeleteOneRestaurant(array $params)
    {
        $restaurant = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "restaurant" . " WHERE id = :id", $params);
        return $restaurant;
    }

    public function getOneRestaurant(int $id)
    {
        $restaurant = parent::databaseFindOne(['id' => $id], "restaurant");
        return $restaurant;
    }

    public function getCompleteRestaurantForm()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "/restaurant/creation",
                "class" => "restaurant-form",
                "id" => "formRestaurant",
                "submit" => "Ajouter le restaurant",
                'captcha' => false,
            ],
            "inputs" => [
                "user_id" => [
                    "type" => "hidden",
                    "id" => "user_id",
                    "value" => $_SESSION['user']['id'],
                ],
                "name" => [
                    "placeholder" => "Nom du restaurant*",
                    "type" => "text",
                    "id" => "name",
                    "class" => "restaurant-name",
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
                    "label" => "Adresse du restaurant",
                    "class" => "restaurant-inputs",
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
                    "label" => "Complément d'adresse",
                    "class" => "restaurant-inputs",
                    "max" => 255,
                    "value" => $this->additional_address,
                    "error" => "Le champs complément d'adresse contient une erreur"
                ],
                "city" => [
                    "placeholder" => "Ville*",
                    "type" => "text",
                    "id" => "city",
                    "label" => "Ville",
                    "class" => "restaurant-inputs",
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
                    "label" => "Code Postal",
                    "class" => "restaurant-inputs",
                    "required" => true,
                    "min" => 1,
                    "max" => 10,
                    "value" => $this->zipcode,
                    "error" => "Votre code postal est incorrect",
                ],
                "phone" => [
                    "placeholder" => "Téléphone*",
                    "type" => "number",
                    "id" => "phone",
                    "label" => "Téléphone",
                    "class" => "restaurant-inputs",
                    "required" => true,
                    "min" => 4,
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
    public function getCompleteUpdateRestaurantForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/update",
                "class" => "restaurant-form",
                "id" => "restaurant-form",
                "submit" => "Enregistrer",
                'captcha' => false,
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "formRestaurant",
                    "value" => intval($this->id),
                ],
                "name" => [
                    "placeholder" => "Nom du restaurant*",
                    "type" => "text",
                    "id" => "name",
                    "class" => "restaurant-name",
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
                    "class" => "restaurant-inputs",
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
                    "class" => "restaurant-inputs",
                    "max" => 255,
                    "value" => $this->additional_address,
                    "error" => "Le champs complément d'adresse contient une erreur"
                ],
                "city" => [
                    "placeholder" => "Ville*",
                    "type" => "text",
                    "id" => "city",
                    "class" => "restaurant-inputs",
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
                    "class" => "restaurant-inputs",
                    "required" => true,
                    "min" => 1,
                    "max" => 10,
                    "value" => $this->zipcode,
                    "error" => "Votre code postal est incorrect",
                ],
                "phone" => [
                    "placeholder" => "Téléphone*",
                    "type" => "number",
                    "id" => "phone",
                    "class" => "restaurant-inputs",
                    "required" => true,
                    "min" => 4,
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


    public function deleteRestaurant()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/delete",
                "id" => "restaurant-delete",
                "submit" => "Supprimer",
                'captcha' => false,
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "class" => "formRestaurant",
                    "value" => $_SESSION["restaurant"]["id"],
                ],
                // "captcha" => [
                //     'type' => 'captcha',
                //     'error' => 'Le captcha n\'a pas pu validé votre formulaire'
                // ]
            ]
        ];
    }
}
