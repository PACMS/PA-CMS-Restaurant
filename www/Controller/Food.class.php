<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Stock as StockModel;
use App\Model\Food as FoodModel;

class Food
{
    public function createFood()
    {
        session_start();
        $food = new FoodModel();
        $food->hydrate($_POST);

        $food->save();
        header('Location: /restaurant/stock');
    }

    public function getOneFood()
    {
        session_start();
        $food = new FoodModel();
        $errors = null;
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
        $view = new View("food", 'back');
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
        $stockId = $_SESSION["stock"]["id"];
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
