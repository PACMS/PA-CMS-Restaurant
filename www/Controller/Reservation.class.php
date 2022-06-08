<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Reservation as ReservationModel;


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
        foreach ($data as $dateReserv ){
            $dateReserv->date = date("d/m/Y", strtotime($dateReserv->date));
        }
        $view = new View("reservation", "back");
        $view->assign('reservation', $reservation);
        $view->assign('data', $data);

    }

    public function addReservation()
    {
        $reservation = new ReservationModel();


        $reservation->hydrate($_POST);
        $clientName = $reservation->getName();
        $reservation->save();
        $data =  $reservation->getAll();

        $view = new View("reservation", "back", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' !');
        $view->assign('reservation', $reservation);
        $view->assign('data', $data);

    }

    public function addReservationClient()
    {
        $reservation = new ReservationModel();

        $reservation->hydrate($_POST);
        $clientName = $reservation->getName();
        $reservation->save();

        $view = new View("reservationClient", "front", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' !');
        $view->assign('reservation', $reservation);

    }
}
