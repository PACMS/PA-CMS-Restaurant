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
            if (empty($_SESSION["id_restaurant"])) {
                header('Location: /restaurants');
            }            
            $builder = new MysqlBuilder();
            $restaurant = $builder
                ->select('restaurant', ["*"])
                ->where("id", $_SESSION["id_restaurant"])
                ->fetchClass("restaurant")
                ->fetch();
            $allCartes = $builder
                ->select('carte', ["*"])
                ->fetchClass("carte")
                ->fetchAll();
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
        $builder = new MysqlBuilder();
        $carte = $builder
            ->select('carte', ["*"])
            ->where("id", $id)
            ->fetchClass("carte")
            ->fetch();
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
        $builder = new MysqlBuilder();
        $carte = $builder
            ->delete('carte', ["id" => $_POST["id"]])
            ->fetchClass("carte")
            ->fetch();
        header('Location: /cartes');
    }

    public function unselectAllCarte()
    {
        session_start();
        $request = new MysqlBuilder();
        $request
            ->update('carte', ["status" => 0])
            ->where("id_restaurant", $_SESSION["id_restaurant"])
            ->fetchClass("carte")
            ->fetchAll();
    }
}
