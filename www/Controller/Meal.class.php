<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Meal as MealModel;
use App\Model\Categorie as CategorieModel;
use App\Model\Restaurant as RestaurantModel;
use App\Model\Carte as CarteModel;

class Meal
{

    public function setIdCard()
    {
        session_start();
        $_SESSION["id_card"] = $_POST["id"];
    }

    public function meal()
    {
        session_start();
        if (empty($_SESSION["id_card"])) {
            header("Location: /restaurants");
        }
        $restaurantModel = new RestaurantModel();
        $restaurant = $restaurantModel->getOneRestaurant(intval($_SESSION["restaurant"]["id"]));
        $carteModel = new CarteModel();
        $carte = $carteModel->getOneCarte(intval($_SESSION["id_card"]));
        $meals = new MealModel();
        $categorie = new CategorieModel();
        $allCategories = $categorie->getAllCategories();
        $allMeals = $meals->getAllMeals(intval($_SESSION["id_card"]));
        $view = new View("meal", "back");
        $view->assign("allMeals", $allMeals);
        $view->assign("categorie", $categorie);
        $view->assign("meal", $meals);
        $view->assign("categories", $allCategories);
        $view->assign("restaurantName", $restaurant["name"]);
        $view->assign("carteName", $carte["name"]);
    }

    public function createMeal()
    {
        $meal = new MealModel();
        dd($_POST);
        if (!empty($_POST)) {
            if (is_string($_POST["price"])) {
                //il faut notifier l'utilisateur que l'input doit être un float
            }
            if ($_POST["price"]) {
                $_POST["price"] = floatval($_POST["price"]);
                $meal->hydrate($_POST) .
                    $meal->save();
            }
        }

        header('Location: /restaurant/carte/meals');
    }

    public function updateMeal()
    {
        $meal = new MealModel();
        $meal->hydrate($_POST) .
            $meal->save();

        header('Location: /restaurant/carte/meals');
    }

    public function deleteMeal()
    {
        $meal = new MealModel();
        $meal->deleteMeal($_POST["id"]);
        //header('Location: /restaurants');
    }
}
