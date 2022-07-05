<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Reservation as ReservationModel;
use App\Core\MysqlBuilder;
// use Comment controller
use App\Controller\Comment;


class Reservation
{
    public function index()
    {
        $view = new View("reservationClient");
        $reservation = new ReservationModel();
        $view->assign('reservation', $reservation);
    }

    public function reservation()
    {
        $reservation = new ReservationModel();
        $data =  $reservation->getAll();
        foreach ($data as $dateReserv) {
            $dateReserv->date = date("d/m/Y", strtotime($dateReserv->date));
        }
        $view = new View("reservation", "back");
        $view->assign('reservation', $reservation);
        $view->assign('data', $data);
    }

    public function addReservation()
    {
        $reservation = new ReservationModel();
        $_POST["status"] = 0;
        if ($_POST["status"] != 0) {
            dd("gerer l'erreur du status");
        }
        $reservation->hydrate($_POST);
        $clientName = $reservation->getName();
        $reservation->save();
        $data =  $reservation->getAll();
        return header("Location: /reservation");
        // $view = new View("reservation", "back", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' !');
        // $view->assign('reservation', $reservation);
        // $view->assign('data', $data);

    }

    public function addReservationClient()
    {
        $reservation = new ReservationModel();
        $_POST["status"] = 0;
        if ($_POST["status"] != 0) {
            dd("gerer l'erreur du status");
        }
        $reservation->hydrate($_POST);
        $clientName = $reservation->getName();
        $reservation->save();

        $view = new View("reservationClient", "front", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' !');
        $view->assign('reservation', $reservation);
    }

    public function completeReservation()
    {
        $request = new MysqlBuilder();
        $request
            ->update('reservation', ["status" => 1])
            ->where("id", $_POST["id"])
            ->fetchClass("reservation")
            ->execute();
        $currentReservation = $request->select("reservation", ["*"])->where("id", $_POST["id"])
            ->fetchClass("reservation")
            ->fetch();
        $test = new Comment();
        $test->mailAskForComment($currentReservation->getEmail(), $currentReservation->getName(), $_SESSION["restaurant"]["id"]);
    }
}
