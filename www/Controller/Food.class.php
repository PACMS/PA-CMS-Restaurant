<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Stock as StockModel;
use App\Model\Food as FoodModel;
use App\Core\MysqlBuilder;

class Food
{
    public function createFood()
    {
        session_start();
        $_POST = array_map('htmlspecialchars', $_POST);
        $food = new FoodModel();
        $errors = null;
        if(!empty($_POST)) {
            $errors = Verificator::checkForm($food->getAddProduct(), $_POST);
            if(empty($errors)) {
                $food->hydrate($_POST);
                $food->save();
                header('Location: /food');
            }
            header('Location: /restaurant/stock');
        }
        header('Location: /restaurant/stock');
    }

    public function getOneFood()
    {
        session_start();
        $food = new FoodModel();
        $errors = null;
        $_POST = array_map('htmlspecialchars', $_POST);
        $allFoods = $food->getAllFoods(['stockId' => $_SESSION["stock"]["id"]]);
        $foodArray = [];
        if (empty($_POST)) {
            return header('Location: /restaurant/stock');
        }

        $errors = Verificator::checkForm($food->editFoodInfo(), $_POST + $_FILES);
        if (!$errors) {
            foreach ($allFoods as $value) {
                array_push($foodArray, $value["id"]);
            }
            if (!in_array($_POST["id"], $foodArray)) {
                return header("Location: /restaurant/stock");
            }
            $oneFood = $food->getOneFood('food', $_POST["id"]);
            $food->hydrate($oneFood);
            $view = new View("food");
            $view->assign('food', $food);
            $view->assign('oneFood', $oneFood);
        }
    }

    public function updateFood()
    {
        session_start();
        $food = new FoodModel();
        $errors = null;
        $allFoods = $food->getAllFoods(['stockId' => $_SESSION["stock"]["id"]]);
        $foodArray = [];
        foreach ($allFoods as $value) {
            array_push($foodArray, $value["id"]);
        }

        if (!empty($_POST) && !empty($_POST["id"]) && is_numeric($_POST["quantity"]) && in_array($_POST["id"], $foodArray) && $_POST["stockId"] == $_SESSION["stock"]["id"]) {
            $_POST = array_map('htmlspecialchars', $_POST);
            $errors = Verificator::checkForm($food->updateFoodForm(), $_POST + $_FILES);
            if (!$errors) {
                $food->hydrate($_POST);
                $food->save();

                return header('Location: /restaurant/stock');
            }
        }
        return header('Location: /restaurant/stock');
    }

    public function deleteFood()
    {
        session_start();
        $food = new FoodModel();
        $errors = null;
        if(!empty($_POST)){
            $_POST = array_map('htmlspecialchars', $_POST);
            $stockId = $_SESSION["stock"]["id"];
            $errors = Verificator::checkForm($food->deleteFoodForm($_POST["id"]), $_POST + $_FILES);
            if(!$errors){

                $allFoods = $food->getAllFoods(['stockId' => $stockId]);
                $foodArray = [];
                foreach ($allFoods as $value) {
                    array_push($foodArray, $value["id"]);
                }
                if (!in_array($_POST["id"], $foodArray)) {
                    return header("Location: /restaurant/stock");
                }
                $food->deleteFood($_POST['id']);
                return header('Location: /restaurant/stock');
            }
        }
        return header('Location: /restaurant/stock');
    }

    public function getFoodStats()
    {
        $builder = new MysqlBuilder();
        $foods = $builder->select('food', ["quantity", "name"])
            ->where('stockId', $_SESSION["stock"]["id"])
            ->order('quantity', 'asc')
            ->limit(10)
            ->fetchClass("food")
            ->fetchAll();
        return $foods;
    }

    public function getFoodStatsByMeal()
    {
        $builder = new MysqlBuilder();
        $foods = $builder->select('mealsFoods mf', ["*"])
            ->rightJoin('meal m', 'm.id', 'mf.meal_id')
            ->rightJoin('carte c', 'c.id', 'm.id_carte')
            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
            ->where("status", 1)
            ->fetchClass("mealsFoods")
            ->fetchAll();

        $myFoods = [];
        foreach ($foods as $food) {
            array_push($myFoods, $food->getFoodId());
        }

        $vals = array_count_values($myFoods);
        $foodMealObj = [];
        $keys = array_keys($vals);

        for ($i = 0; $i < count($keys); $i++) {
            $name = $builder->select('food', ["name"])
                ->where('id', $keys[$i])
                ->fetchClass("food")
                ->fetch();

            $foodMealObj[$i] = new \stdClass();
            $foodMealObj[$i]->name = $name->getName();
            $foodMealObj[$i]->repeat = intval($vals[$keys[$i]]);
        }
        return $foodMealObj;
    }
}
