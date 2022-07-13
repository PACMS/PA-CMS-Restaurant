<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Controller\Reservation;
use App\Controller\Food;

class Stats
{
    public function stats()
    {
        session_start();
        $view = new View("statistiques", "back");
        $food = new Food();
        $foods = $food->getFoodStats();
        $foodMeal = $food->getFoodStatsByMeal();
        $view->assign('foodMeal', $foodMeal);
        $foodObj = [];
        for($i = 0; $i < count($foods); $i++) {
            $foodObj[$i] = new \stdClass();
            $foodObj[$i]->name = $foods[$i]->getName();
            $foodObj[$i]->quantity = intval($foods[$i]->getQuantity());
        }

        $reservation = new Reservation();
        $nbReservations = $reservation->getReservationsStats();
        
        $view->assign('stats', $nbReservations);
        $view->assign('foodQuantity', $foodObj);
    }    
    

}
