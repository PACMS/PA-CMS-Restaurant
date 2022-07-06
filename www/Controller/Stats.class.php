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

        $foodObj = [];
        for($i = 0; $i < count($foods); $i++) {
            $foodObj[$i] = new \stdClass();
            $foodObj[$i]->name = $foods[$i]->getName();
            $foodObj[$i]->quantity = intval($foods[$i]->getQuantity());
        }

        $reservation = new Reservation();
        $data = $reservation->getReservationsStats();
        $nbReservations = [];
        for($i = 0; $i < 15; $i++) {
            $theDate = new \DateTime();
            $nb = 0;
            $formatedDate = $theDate->modify('+' . $i .  'day')->format('Y-m-d');
            foreach($data as $value) {

                 if($value["date"] == $formatedDate) {
                    $nb++;
                 }
            }
            array_push($nbReservations, $nb);
        }
        $view->assign('stats', $nbReservations);
        $view->assign('foodQuantity', $foodObj);
        $view->assign('foodMeal', $foodMeal);
    }    
    

}
