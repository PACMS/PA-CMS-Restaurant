<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\CreatePage;
use App\Core\View;
use App\Model\Page;
use App\Model\Restaurant as RestaurantModel;

class Restaurant
{

    public function restaurant()
    {
        $restaurant = new RestaurantModel();
        // utiliser la fonction getAllRestaurant() de RestaurantModel
        $allRestaurants = $restaurant->getAllRestaurants();
        $view = new View("restaurants");
        $view->assign('restaurant', $allRestaurants);
    }

    public function deleteRestaurant()
    {
        $restaurant = new RestaurantModel();
        $table = "restaurant";
        $id = $_POST['id'];
        $restaurant->databaseDeleteOneRestaurant($table, $id);
        header('Location: /restaurants');
    }

    public function getOneRestaurant()
    {
        $restaurant = new RestaurantModel();
        $id = $_POST["id"];
        $_SESSION["id_restaurant"] = $id;

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
        $page = new Page();
        $errors = null;
        // if (!empty($_POST)) {

        // $errors = Verificator::checkForm($restaurant->getCompleteRegisterForm(), $_POST + $_FILES);

        $restaurant->hydrate($_POST);

        $dirname = $_SERVER["DOCUMENT_ROOT"] . '/View/pages/' . $restaurant->getName() . '/';
        $url ='/pages/' . $restaurant->getName() . '/index';
        if (!is_dir($dirname))
        {
          mkdir($dirname, 0755, true) ;
          $fp = fopen('View/' . $url . '.view.php', 'w+');
          (new \App\Core\CreatePage)->createBasicPageIndex($fp);

        }
        $restaurant->save();
        $pageRestaurant = $restaurant->findOneBy(['name' => $restaurant->getName()]);
        $page->setUrl($url);
        $page->setStatus(0);
        $page->setIdRestaurant($pageRestaurant['id']);

        $page->save();

        header('Location: /restaurants');
    }

    public function updateRestaurant()
    {
        $restaurant = new RestaurantModel();
        $errors = null;



        $view = new View("create-restaurant");
        $view->assign('restaurant', $restaurant);
        $view->assign("errors", $errors);
    }

    public function restaurantOptions()
    {

        $restaurant = new RestaurantModel();
        $table = "restaurant";
        $id = $_POST["id"];
        $_SESSION["id_restaurant"] = $id;
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
