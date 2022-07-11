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
        $mealsFoods = $builder->select("mealsFoods", ["*"])
        ->fetchClass("mealsFoods")
        ->fetchAll();
        $foods = [];
        $_SESSION["stock"]["allFoodsIds"] = [];
        foreach ($food as $value) {
            $foods[$value->getId()] = $value->getName();
            $_SESSION["stock"]["allFoodsIds"][] = $value->getId();
        }
        $view = new View("meal", "back");
        $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Menu ' . $carte["name"]);
        $view->assign("allMeals", $allMeals);
        $view->assign("categorie", $categorie);
        $view->assign("meal", $meals);
        $view->assign("categories", $allCategories);
        $view->assign("food", $foods);
        $view->assign("restaurantName", $restaurant["name"]);
        $view->assign("carteName", $carte["name"]);
        $view->assign("mealsFoods", $mealsFoods);
    }

    public function createMeal()
    {
        session_start();
        if (!empty($_POST)) {
            if (!is_null($_POST["ingredients"])) {
                $ingredients = $_POST["ingredients"];
                unset($_POST["ingredients"]);
                $_POST = array_map('htmlspecialchars', $_POST);
                $ingredients = array_map('htmlspecialchars', $ingredients);
                $_POST["ingredients"] =  $ingredients;
            } else {
                $_POST = array_map('htmlspecialchars', $_POST);
            }
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

    // public function updateMeal()
    // {
    //     @session_start();
    //     $errors = null;
    //     if (!is_null($_POST["ingredients"])) {
    //         $ingredients = $_POST["ingredients"];
    //         unset($_POST["ingredients"]);
    //         $_POST = array_map('htmlspecialchars', $_POST);
    //         $ingredients = array_map('htmlspecialchars', $ingredients);
    //         $_POST["ingredients"] =  $ingredients;
    //     } else {
    //         $_POST = array_map('htmlspecialchars', $_POST);
    //     }
    //     $_POST["price"] = floatval($_POST["price"]);
    //     $builder = new MysqlBuilder();
    //         if (!empty($_POST["ingredients"])) {

    //             $foods = $_POST["ingredients"];
    //             unset($_POST["ingredients"]);
    //         } else {
    //             $builder->delete("mealsFoods", ["meal_id" => $_POST["id"]])
    //                     ->fetchClass("mealsFoods")
    //                     ->execute();
    //         }
    //         $builder->update("meal", ["name" => $_POST["name"], "price" => $_POST["price"], "description" => $_POST["description"]])
    //                 ->where("id", $_POST["id"])
    //                 ->fetchClass("meal")
    //                 ->execute();
    //         if (!is_null($foods)) {
    //             $mealsFoods = $builder->select("mealsFoods", ["*"])
    //                     ->where("meal_id", $_POST["id"])
    //                     ->fetchClass("mealsFoods")
    //                     ->fetchAll();
                        
    //             foreach ($foods as $foodValue) {
    //                 if (!empty($mealsFoods)) {
    //                     foreach ($mealsFoods as $mealFoodValue) {
    //                         if ($foodValue == $mealFoodValue->getFoodId() &&  $_POST["id"] == $mealFoodValue->getMealId() ) {
    //                             // $builder->insert("mealsFoods", ["meal_id" =>  $_POST["id"], "food_id" => $foodValue])
    //                             //     ->fetchClass("mealsFoods")
    //                             //     ->execute();
    //                             var_dump($foodValue . " est en base apres verif");
    //                         } else if ($foodValue != $mealFoodValue->getFoodId() &&  $_POST["id"] == $mealFoodValue->getMealId()) {
    //                             var_dump($foodValue . " n'est pas en base");
    //                             // $builder->insert("mealsFoods", ["meal_id" =>  $_POST["id"], "food_id" => $foodValue])
    //                             //     ->fetchClass("mealsFoods")
    //                             //     ->execute();
    //                         }
    //                     } 
    //                 } else {
    //                     // $builder->insert("mealsFoods", ["meal_id" =>  $_POST["id"], "food_id" => $foodValue])
    //                     // ->fetchClass("mealsFoods")
    //                     // ->execute();
    //                     var_dump("on insert car la base est vide");
    //                 }
    //             }
    //         }
    //     // dd($_POST);
    //     // $meal = new MealModel();
    //     // $errors = Verificator::checkForm($meal->getUpdateMeal([], [], []), $_POST + $_FILES);
    //     // if (!$errors) {
    //         // $meal->hydrate($_POST) .
    //         // $meal->save();
    //     // } 
    //     die();
    //     header('Location: /restaurant/carte/meals');
    // }
    public function updateMeal()
    {
        @session_start();
        $errors = null;
        if (!empty($_POST["ingredients"])) {
            $ingredients = $_POST["ingredients"];
            unset($_POST["ingredients"]);
            $_POST = array_map('htmlspecialchars', $_POST);
            $ingredients = array_map('htmlspecialchars', $ingredients);
            $_POST["ingredients"] =  $ingredients;
        } else {
            $_POST = array_map('htmlspecialchars', $_POST);
        }
        $_POST["price"] = floatval($_POST["price"]);
        $builder = new MysqlBuilder();
        $builder->update("meal", ["name" => $_POST["name"], "price" => $_POST["price"], "description" => $_POST["description"]])
                        ->where("id", $_POST["id"])
                        ->fetchClass("meal")
                        ->execute();
        if (!empty($ingredients)) {
            $mealsFoods = $builder->select("mealsFoods", ["*"])
            ->where("meal_id", $_POST["id"])
            ->fetchClass("mealsFoods")
            ->fetchAll();
            if (empty($mealsFoods)) {
                foreach ($ingredients as $ingredient) {
                    $builder->insert("mealsFoods", ["meal_id" =>  $_POST["id"], "food_id" => $ingredient])
                       ->fetchClass("mealsFoods")
                       ->execute();
                }
            } else {
                $mealsFoodsId = [];
                foreach($mealsFoods as $mealFood) {
                    array_push($mealsFoodsId, $mealFood->getFoodId());
                }
                foreach ($ingredients as $ingredient) {
                    if (!in_array($ingredient, $mealsFoodsId)) {
                        $builder->insert("mealsFoods", ["meal_id" =>  $_POST["id"], "food_id" => $ingredient])
                        ->fetchClass("mealsFoods")
                        ->execute();
                    }
               }
            }
        }
        header('Location: /restaurant/carte/meals');
    }

    public function deleteMeal()
    {
        $meal = new MealModel();
        $meal->deleteMeal($_POST["id"]);
        //header('Location: /restaurants');
    }
}
