<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\CreatePage;
use App\Core\View;
use App\Model\Content;
use App\Model\Page;
use App\Model\Restaurant as RestaurantModel;
use App\Model\Stock as StockModel;

class Restaurant
{


    // Récuperer tout les restaurants sur la page /restaurants
    public function restaurant()
    {
        session_start();
        unset($_SESSION["restaurant"]["id"]);
        $restaurant = new RestaurantModel();
        // utiliser la fonction getAllRestaurant() de RestaurantModel
        $allRestaurants = $restaurant->getAllRestaurants(['user_id' => $_SESSION["user"]["id"]]);
        $restaurantsIds = [];
        foreach ($allRestaurants as $restau) {
            array_push($restaurantsIds, $restau["id"]);
        }
        $_SESSION["restaurantsIds"] = $restaurantsIds;
        $view = new View("restaurants");
        $view->assign('restaurant', $allRestaurants);
    }

    // Supprimer un restaurant depuis la page /restaurant/information
    public function deleteRestaurant()
    {
        session_start();
        if (!$_SESSION["restaurant"] || !$_SESSION["restaurant"]["id"]) {
            header('Location: /restaurants');
        }
        $restaurant = new RestaurantModel();
        $restaurant->databaseDeleteOneRestaurant(["id" => $_SESSION["restaurant"]["id"]]);
        $_SESSION["restaurant"]["id"] = null;
        header('Location: /restaurants');
    }

    // Formulaire update restaurant /restaurant/information
    public function getOneRestaurant()
    {
        session_start();
        $restaurant = new RestaurantModel();


        $table = "restaurant";
        $oneRestaurant = $restaurant->getOneRestaurant($table, $_SESSION["restaurant"]["id"]);
        $restaurant->hydrate($oneRestaurant);
        $view = new View("restaurant-info");
        $view->assign('restaurant', $restaurant);
        $view->assign('oneRestaurant', $oneRestaurant);
    }

    // Creation du restaurant
    public function createOneRestaurant()
    {
        $restaurant = new RestaurantModel();
        $page = new Page();

        session_start();
        //dd($_POST, $_POST["user_id"], $_SESSION);
        if (!empty($_POST) && $_POST["user_id"] == $_SESSION["user"]["id"]) {

            $errors = Verificator::checkForm($restaurant->getCompleteRestaurantForm(), $_POST + $_FILES);
            if (!$errors) {
                $restaurant->hydrate($_POST);

                $dirname = $_SERVER["DOCUMENT_ROOT"] . '/View/pages/' . $restaurant->getName() . '/';
                $url ='pages/' . $restaurant->getName() . '/index';
                if (!is_dir($dirname))
                {
                    mkdir($dirname, 0755, true) ;
                    $fp = fopen('View/' . $url . '.view.php', 'w+');
                    $inputs['title'] = 'index';
                    $array_body[] = "Hello World" ;
                    (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $array_body);
                    fclose($fp);
                }
                $restaurant->save();
                $pageRestaurant = $restaurant->findOneBy(['name' => $restaurant->getName()]);
                $page->setTitle($inputs['title']);
                $page->setUrl($url);
                $page->setStatus(0);
                $page->setIdRestaurant($pageRestaurant['id']);
                $page->save();
                $page = $page->findOneBy(['url' => $page->getUrl()]);
                $content = new Content();
                $content->setIdPage($page['id']);
                $content->setBody($array_body[0]);
                $content->save();

                $restaurantId =  $restaurant->last()->id;
                $stock = new StockModel;
                $stock->hydrate(['restaurantId' => $restaurantId]);
                $stock->save();
                return header('Location: /restaurants');
            }
        }

        return header('Location: /restaurant/create');
    }

    // Validation update restaurant 
    public function updateRestaurant()
    {
        session_start();
        $restaurant = new RestaurantModel();
        $errors = null;
        if (!empty($_POST) && $_POST["id"] == $_SESSION["restaurant"]["id"]) {
            $errors = Verificator::checkForm($restaurant->getCompleteUpdateRestaurantForm(), $_POST + $_FILES);
            if (!$errors) {
                $restaurant->hydrate($_POST);
                $restaurant->save();
                return header('Location: /restaurants');
            }
        }
        return header('Location: /restaurant/information');
    }

    // Formulaire de creation de restaurant /restaurant/create
    public function createRestaurantForm()
    {

        $restaurant = new RestaurantModel();
        $errors = null;
        $view = new View("create-restaurant");
        $view->assign('restaurant', $restaurant);
        $view->assign("errors", $errors);
    }

    // Page avec les options pour un restaurant /restaurant
    public function restaurantOptions()
    {
        session_start();
        if (!in_array($_POST["id"], $_SESSION["restaurantsIds"])) {
            return header('Location: /restaurants');
        }
        $id = $_POST["id"];
        $_SESSION["restaurant"]["id"] = intval($id);
        $restaurant = new RestaurantModel();
        $table = "restaurant";
        $oneRestaurant = $restaurant->getOneRestaurant($table, $id);
        $_SESSION["restaurant"]["name"] = $oneRestaurant["name"];
        $restaurant->hydrate($oneRestaurant);
        $view = new View("restaurant");

        $view->assign('restaurant', $restaurant);
        $view->assign('oneRestaurant', $oneRestaurant);
    }
}
