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
        $theStock = $stock->getOneStock('stock', ['restaurantId' => $_SESSION["restaurant"]["id"]]);
        if (!$theStock) {
            $stock->hydrate(['restaurantId' => $_SESSION["restaurant"]["id"]]);
            $_SESSION["restaurant"]["id"] = null;
            $stock->save();
        }
        $food = new FoodModel();
        $stockId = $theStock["id"];
        $_SESSION["stock"]["id"] = $stockId;
        $allFoods = $food->getAllFoods(['stockId' => $stockId]);

        $view = new View("stock");
        $view->assign('stock', $stock);
        $view->assign('food', $food);
        $view->assign('allFoods', $allFoods);
    }
}
