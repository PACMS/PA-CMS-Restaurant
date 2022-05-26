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
}
