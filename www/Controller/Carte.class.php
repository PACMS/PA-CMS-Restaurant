<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Core\MysqlBuilder;
use App\Model\Carte as CarteModel;
use App\Model\Restaurant as RestaurantModel;

class Carte
{

    public function carte()
    {
        if (empty($_GET)) {
            $carte = new CarteModel();
            $restaurantModel = new RestaurantModel();
            session_start();
            if (empty($_SESSION["restaurant"]["id"])) {
                header('Location: /restaurants');
            }
            $restaurant = $restaurantModel->getOneRestaurant("restaurant", $_SESSION["restaurant"]["id"]);
            $allCartes = $carte->getAllCartes();
            $view = new View("cartes", "back");
            $view->assign('cartes', $allCartes);
            $view->assign('restaurant', $restaurant);
        } elseif (!empty($_GET["id"])) {
            $this->showCarte($_GET["id"]);
        }
    }

    public function createCarte()
    {
        $carte = new CarteModel();
        $view = new View("createCarte", "back");
        $view->assign("carte", $carte);
    }

    public function showCarte(string $id)
    {
        $carteCtrl = new CarteModel();
        $view = new View("carteDetails", "back");
        $carte = $carteCtrl->getOneCarte($id);
        $view->assign('carte', $carte);
        $view->assign('carteCtrl', $carteCtrl);
    }

    public function updateCarte()
    {
        $carte = new CarteModel();
        if (empty($_POST["status"])) {
            $_POST["status"] = 0;
        } else {
            $_POST["status"] = 1;
        }
        $carte->hydrate($_POST);
        $this->unselectAllCarte();
        $carte->save();
        header('Location: /cartes');
    }

    public function deleteCarte()
    {
        $carte = new CarteModel();
        $carte->deleteCarte($_POST["id"]);
        header('Location: /cartes');
    }

    public function unselectAllCarte()
    {
        session_start();
        $carte = new CarteModel();
        $allCartes = $carte->getAllCartes();

        $queryBuilder = new MysqlBuilder();
        $queryBuilder
            ->update('carte', ["status" => 0])
            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
            ->executeQuery();
    }
}
