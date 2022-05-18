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
        $carteCtrl = new CarteController();
        $view = new View("carteDetails", "back");
        $carte = $carteCtrl->getOneCarte($id);
        $view->assign('carte', $carte);
        $view->assign('carteCtrl', $carteCtrl);
    }

    public function updateCarte()
    {
        $reservation = new CarteController();
        if (empty($_POST["status"])) {
            $_POST["status"] = 0;
        } else {
            $_POST["status"] = 1;
        }
        $reservation->hydrate($_POST);
        $reservation->save();
        header('Location: /cartes');
    }
}
