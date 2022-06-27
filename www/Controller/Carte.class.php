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
            session_start();
            if (empty($_SESSION["restaurant"]["id"])) {
                header('Location: /restaurants');
            }
            $builder = new MysqlBuilder();
            $restaurant = $builder
                ->select('restaurant', ["*"])
                ->where("id", $_SESSION["restaurant"]["id"])
                ->fetchClass("restaurant")
                ->fetch();
            $allCartes = $builder
                ->select('carte', ["*"])
                ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                ->fetchClass("carte")
                ->fetchAll();
            $allCartesIds = [];
            foreach ($allCartes as $value) {
                array_push($allCartesIds, $value->getId());
            }
            $_SESSION["restaurant"]["cartesIds"]   = $allCartesIds;
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
        session_start();
        dd($id, $_SESSION["restaurant"]["cartesIds"]);
        if (!in_array($id, $_SESSION["restaurant"]["cartesIds"])) {
            header('Location: /restaurant/cartes');
        }
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
        if ($_POST["status"] === 1) {
            $this->unselectAllCarte();
        }
        $carte->save();
        header('Location: /restaurant/cartes');
    }

    public function deleteCarte()
    {
        $builder = new MysqlBuilder();
        $carte = $builder
            ->delete('carte', ["id" => $_POST["id"]])
            ->fetchClass("carte")
            ->fetch();
        header('Location: /restaurant/cartes');
    }

    public function unselectAllCarte()
    {
        session_start();
        $request = new MysqlBuilder();
        $request
            ->update('carte', ["status" => 0])
            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
            ->fetchClass("carte")
            ->fetchAll();
    }
}
