<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Restaurant as RestaurantModel;
use App\Model\Stock as StockModel;

class Restaurant
{
    public function restaurant()
    {
        session_start();
        $restaurant = new RestaurantModel();
        // utiliser la fonction getAllRestaurant() de RestaurantModel
        $allRestaurants = $restaurant->getAllRestaurants();
        $restaurantsIds = [];
        foreach($allRestaurants as $restau)
        {
            array_push($restaurantsIds, $restau["id"]);
        }
        $_SESSION["restaurantsIds"] = $restaurantsIds;
        $view = new View("restaurants");
        $view->assign('restaurant', $allRestaurants);
    }

    public function deleteRestaurant()
    {
        session_start();
        if(!$_POST || !$_POST["id"] || $_SESSION["restaurant"] || $_SESSION["restaurant"]["id"] || $_POST["id"] !== $_SESSION["restaurant"]["id"]){
            header('Location: /restaurants');
        }
        $restaurant = new RestaurantModel();
        $table = "restaurant";
        $restaurant->databaseDeleteOneRestaurant($table, $_SESSION["restaurant"]["id"]);
        header('Location: /restaurants');
    }

    public function getOneRestaurant()
    {
        $restaurant = new RestaurantModel();
        $id = $_POST["id"];
        $_SESSION["restaurant"]["id"] = $id;

        $table = "restaurant";
        $oneRestaurant = $restaurant->getOneRestaurant($table, $id);
        $restaurant->hydrate($oneRestaurant);
        $view = new View("restaurant-info");
        $view->assign('restaurant', $restaurant);
        $view->assign('oneRestaurant', $oneRestaurant);
    }

    public function createOneRestaurant()
    {
        $restaurant = new RestaurantModel();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($restaurant->getCompleteRestaurantForm(), $_POST + $_FILES);

            if (!$errors) {

                $restaurant->hydrate($_POST);
                // $restaurant->setId(null);
                $restaurant->save();
                $restaurantId =  $restaurant->last()->id;
                $stock = new StockModel;
                $stock->hydrate(['restaurantId' => $restaurantId]);
                $stock->save();
            }
        }
        header('Location: /restaurants');
    }

    public function updateRestaurant()
    {
        session_start();
        $restaurant = new RestaurantModel();
        $errors = null;

        if (!empty($_POST) && $_POST["id"] === $_SESSION["restaurant"]["id"]) {
            $errors = Verificator::checkForm($restaurant->getCompleteUpdateRestaurantForm(), $_POST + $_FILES);

            if (!$errors) {

                $restaurant->hydrate($_POST);
                // $restaurant->setId(null);
                $restaurant->save();
            }
        }
        header('Location: /restaurants');
    }

    public function updateRestaurantForm()
    {
        $restaurant = new RestaurantModel();
        $errors = null;
        $view = new View("create-restaurant");
        $view->assign('restaurant', $restaurant);
        $view->assign("errors", $errors);
    }

    public function restaurantOptions()
    {
        session_start();
        if(!in_array( $_POST["id"], $_SESSION["restaurantsIds"])){
            return header('Location: /restaurants');
        }
        $id = $_POST["id"];
        $_SESSION["restaurant"]["id"] = $id;
        $restaurant = new RestaurantModel();
        $table = "restaurant";
        $oneRestaurant = $restaurant->getOneRestaurant($table, $id);
        $restaurant->hydrate($oneRestaurant);
        $view = new View("restaurant");
        $view->assign('restaurant', $restaurant);
        $view->assign('oneRestaurant', $oneRestaurant);
    }

    public function stock()
    {
        var_dump("SESSION", $_SESSION);
        // $view = new View("stock");
    }
}
