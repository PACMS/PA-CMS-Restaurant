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
            if (empty($_SESSION["id_restaurant"])) {
                header('Location: /restaurants');
            }
        } elseif (!empty($_GET["id"])) {
            $this->showCarte($_GET["id"]);
        }
    }

    public function createCarte()
    {
        $carte = new CarteController();
        $view = new View("createCarte", "back");
        $view->assign("carte", $carte);
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
        $carte = new CarteController();
        if (empty($_POST["status"])) {
            $_POST["status"] = 0;
        } else {
            $_POST["status"] = 1;
        }
        $carte->hydrate($_POST);
        $carte->save();
        header('Location: /cartes');
    }

    public function deleteCarte()
    {
        $carte = new CarteController();
        $carte->deleteCarte($_POST["id"]);
        header('Location: /cartes');
    }
}
