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
        // $id = $_SESSION["id_restaurant"];
        session_start();
        if(!empty($_POST["id"])){

            $_SESSION["id_restaurant"] = $_POST["id"];
        }
        $stock = new StockModel();
        $theStock = $stock->getOneStock('stock',['restaurantId' => $_SESSION["id_restaurant"]] );
        if (!$theStock) {
            $stock->hydrate(['restaurantId' => $_SESSION["id_restaurant"]]);
            $_SESSION["id_restaurant"] = null;
            $stock->save();   
        }
        $food = new FoodModel();
        $stockId = $theStock["id"];
        $_SESSION["id_stock"] = $stockId;
        $allFoods = $food->getAllFoods(['stockId' => $stockId]);
        
        $view = new View("stock");
        $view->assign('stock', $stock);
        $view->assign('food', $food);
        $view->assign('allFoods', $allFoods);
    }
}
