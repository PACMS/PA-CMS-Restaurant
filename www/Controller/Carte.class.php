<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Carte as CarteController;

class Carte
{

    public function carte()
    {
        if (empty($_GET)) {
            $carte = new CarteController();
            $allCartes = $carte->getAllCartes();
            $view = new View("cartes", "back");
            $view->assign('cartes', $allCartes);
        } elseif (!empty($_GET["id"])) {
            $this->showCarte($_GET["id"]);
        }
        
    }

    public function createCarte()
    {
        
    }

    public function showCarte(string $id)
    {
        $carte = new CarteController();
        $view = new View("carteDetails", "back");
        $carte = $carte->getOneCarte($id);
        $view->assign('carte', $carte);
    }

    public function updateCarte()
    {
        $reservation = new CarteController();
        $reservation->hydrate($_POST);
        dd($reservation);
        //$reservation->save();
    }
}
