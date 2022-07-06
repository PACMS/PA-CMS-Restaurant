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

    public function reservationTable()
    {
        $view = new View('table-reservation', 'front');
        $view->assign('reservation', new ReservationModel());
    }

    public function addReservationTable()
    {
        $reservation = new ReservationModel();
        $_POST['status'] = -1;
        $reservation->hydrate($_POST);
        $clientName = $reservation->getName();
        $nbPerson = $reservation->getNumPerson();
        $date = $reservation->getDate();
        $hour = $reservation->getHour();
        $email = $reservation->getEmail();
        $reservation->save();

        $view = new View("reservation", "front", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' ! Un mail de confirmation va vous êtes envoyé');
        $view->assign('reservation', $reservation);
        $this->tempMailReservation($clientName, $date, $hour, $nbPerson, $email);
    }

    public function tempMailReservation (string $name, string $date, string $hour, string $nbPerson, string $email)
    {
        $mail = new Mail();
        $mail->tempMailReservation($name, $date, $hour, $nbPerson, $email);
    }
}
