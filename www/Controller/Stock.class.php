<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Stock as StockModel;

class Stock
{
    public function stock()
    {
        // $id = $_SESSION["id_restaurant"];
        session_start();
        $_SESSION["id_restaurant"] = $_POST["id"];
        var_dump($_SESSION);
        $stock = new StockModel();
        $allStocks = $stock->getAllStocks();
        $temp = false;
        foreach ($allStocks as $key => $value) {
            if ($value["restaurantId"] == $_POST['id']) {
                $temp = true;
                // $allStocks[$key]["restaurantId"] = $_SESSION["id_restaurant"];
            }
        }
        if ($temp == false) {

            $stock->hydrate(['restaurantId' => $_POST['id']]);
            $_POST['id'] = null;
            $stock->save();
        }

        $view = new View("stock");
        $view->assign('stock', $stock);
    }
}
