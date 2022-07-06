<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Stock as StockModel;
use App\Model\Food as FoodModel;

class Stock
{
    public function stock()
    {
        session_start();
        if (!$_SESSION["restaurant"] || !$_SESSION["restaurant"]["id"]) {
            return header("Location: /restaurants");
        }
        $stock = new StockModel();
        $food = new FoodModel();
        $allFoods = $food->getAllFoods(['stockId' => $_SESSION["stock"]["id"]]);
        $view = new View("stock");
        $view->assign('stock', $stock);
        $view->assign('food', $food);
        $view->assign('allFoods', $allFoods);
    }
}
