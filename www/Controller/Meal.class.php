<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Meal as MealModel;
use App\Model\Categorie as CategorieModel;
use App\Model\Restaurant as RestaurantModel;
use App\Model\Carte as CarteModel;
use App\Core\MysqlBuilder;

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
        $builder = new MysqlBuilder();
        $food = $builder->select("food", ["*"])
            ->where("stockId", intval($_SESSION["stock"]["id"]))
            ->fetchClass("food")
            ->fetchAll();

        $foods = [];
        $_SESSION["stock"]["allFoodsIds"] = [];
        foreach ($food as $value) {
            $foods[$value->getId()] = $value->getName();
            $_SESSION["stock"]["allFoodsIds"][] = $value->getId();
        }
        $view = new View("meal", "back");
        $view->assign("allMeals", $allMeals);
        $view->assign("categorie", $categorie);
        $view->assign("meal", $meals);
        $view->assign("categories", $allCategories);
        $view->assign("food", $foods);
        $view->assign("restaurantName", $restaurant["name"]);
        $view->assign("carteName", $carte["name"]);
    }

    public function createMeal()
    {
        session_start();
        if (!empty($_POST)) {
            $errors = null;
            $meal = new MealModel();
            $_POST["price"] = floatval($_POST["price"]);
            $builder = new MysqlBuilder();
            if (!empty($_POST["ingredients"])) {

                $foods = $_POST["ingredients"];
                unset($_POST["ingredients"]);
            }
            $builder->insert("meal", $_POST)
                ->fetchClass("meal")
                ->execute();
            if ($foods) {
                $id = $builder->select("meal", ["id"])
                    ->order("id", "DESC")
                    ->fetch();
                $mealId = $id->getId();
                foreach ($foods as $key => $value) {
                        if(in_array($value, $_SESSION["stock"]["allFoodsIds"])){
                            $lastInserted = $builder->select("mealsFoods", ["meal_id","food_id"])
                            ->order("id", "DESC")
                            ->fetchClass("mealsFoods")
                            ->fetch();
                            
                            if($lastInserted == false || $lastInserted->getFoodId() != $value  || $lastInserted->getMealId() != $mealId ){

                                $builder->insert("mealsFoods", ["meal_id" => $mealId, "food_id" => $value])
                                ->fetchClass("mealsFoods")
                                ->execute();
                            }
                        }
                    }
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
