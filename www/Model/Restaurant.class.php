<?php

namespace App\Model;

use App\Core\Sql;
use App\Core\Cleaner;
use App\Core\MysqlBuilder;
/**
 *
 */
class Restaurant extends Sql
{

    protected $id = null;
    protected $name;
    protected $address;
    protected $additional_address;
    protected $city;
    protected $zipcode;
    protected $phone;
    protected $user_id;
    protected $favorite;
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


    /**
     * @return mixed
     */
    public function getFavorite(): string
    {
        return $this->favorite;
    }

    /**
     * @param mixed $favorite
     */
    public function setFavorite(int $favorite): void
    {
        $this->favorite = $favorite;
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

    public function removeAccents($value)
    {
        $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', ' ', '_', '-', '.', ',', '\'', '\\"', '=', '<', '>');
        $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', '', '', '', '', '', '', '', '' , '','');
        $MaChaine = str_replace($search, $replace, $value);
        return $MaChaine;
    }

    public function unfavoriteAllRestaurants()
    {
        $request = new MysqlBuilder();
        $request
            ->update('restaurant', ["favorite" => 0])
            ->fetchClass("restaurant")
            ->fetchAll();
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
                    "minlength" => 2,
                    "max" => 100,
                    "maxlength" => 100,
                    "value" => $this->name,
                    "error" => "Le nom de votre restaurant n'est pas correct",
                    "unicitycreateresto" => true,
                    "errorunicityresto" => "Ce nom de restaurant est déjà utilisé",
                ],
                "address" => [
                    "placeholder" => "Votre adresse*",
                    "type" => "text",
                    "id" => "address",
                    "label" => "Adresse du restaurant",
                    "class" => "restaurant-inputs",
                    "required" => true,
                    "min" => 2,
                    "minlength" => 2,
                    "max" => 255,
                    "maxlength" => 255,
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
                    "maxlength" => 255,
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
                    "minlength" => 2,
                    "max" => 50,
                    "maxlength" => 50,
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
                    "minlength" => 1,
                    "max" => 10,
                    "maxlength" => 10,
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
                    "minlength" => 4,
                    "max" => 15,
                    "maxlength" => 15,
                    "value" => $this->phone,
                    "error" => "Votre numéro de téléphone est incorrect",
                ],
                "favorite" => [
                    "type" => "checkbox",
                    "additionnalDiv" => false,
                    "checked" => false,
                    "required" => false,
                    "values" => [
                        "favorite" => "Choisir ce restaurant en tant que favori",
                    ],
                    "error" => "Erreur dans le choix du restaurant favori",
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
                    "minlength" => 2,
                    "max" => 100,
                    "maxlength" => 100,
                    "value" => $this->name,
                    "error" => "Le nom de votre restaurant n'est pas correct",
                    "unicityresto" => true,
                    "errorunicityresto" => "Ce nom de restaurant est déjà utilisé",
                ],
                "address" => [
                    "placeholder" => "Votre adresse*",
                    "type" => "text",
                    "id" => "address",
                    "class" => "restaurant-inputs",
                    "required" => true,
                    "min" => 2,
                    "minlength" => 2,
                    "max" => 255,
                    "maxlength" => 255,
                    "value" => $this->address,
                    "error" => "Le champs adresse contient une erreur",
                ],
                "additional_address" => [
                    "placeholder" => "Complément d'adresse",
                    "type" => "text",
                    "id" => "additional_address",
                    "class" => "restaurant-inputs",
                    "max" => 255,
                    "maxlength" => 255,
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
                    "minlength" => 2,
                    "max" => 50,
                    "maxlength" => 50,
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
                    "minlength" => 1,
                    "max" => 10,
                    "maxlength" => 10,
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
                    "minlength" => 4,
                    "max" => 15,
                    "maxlength" => 15,
                    "value" => $this->phone,
                    "error" => "Votre numéro de téléphone est incorrect",
                ],
                "favorite" => [
                    "type" => "checkbox",
                    "additionnalDiv" => false,
                    "checked" => $this->favorite,
                    "required" => false,
                    "values" => [
                        "favorite" => "Choisir ce restaurant en tant que favori",
                    ],
                    "error" => "Erreur dans le choix du restaurant favori",
                ],
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
            ]
        ];
    }

    public function selectRestaurant(int $id)
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant",
                "submit" => "Accéder",
                'captcha' => false,
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "name" => "id",
                    "value" => $id,
                ],
            ]
        ];
    }
}