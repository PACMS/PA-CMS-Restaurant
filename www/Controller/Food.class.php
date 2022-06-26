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
    }
}
