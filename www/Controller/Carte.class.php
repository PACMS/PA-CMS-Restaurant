<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Carte as CarteController;

class Carte
{
    public function carte()
    {
        $carte = new CarteController();
        // utiliser la fonction getAllRestaurant() de RestaurantModel
        $allCartes = $carte->getAllCartes();
        $view = new View("cartes", "back");
        $view->assign('carte', $allCartes);
    }
}
