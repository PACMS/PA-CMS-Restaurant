<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Reservation as ReservationModel;


class Reservation
{
    public function reservation()
    {
        $reservation = new ReservationModel();
        $reservation->getAll();
        die(print_r($reservation[0]));
        $view = new View("reservation", "back");
        $view->assign('reservation', $reservation);
        /*$view->assign('dateNow', $dateNow);
        $view->assign('futureDate', $futureDate);*/
    }

    public function addReservation()
    {
        $reservation = new ReservationModel();
        if (!empty($_POST)) {
            Verificator::checkForm($reservation->getModalForm(), $_POST + $_FILES);
        }

        $reservation->hydrate($_POST);
        //die(print_r($reservation));
        $reservation->save();
        $view = new View("reservation", "back");
        $view->assign('reservation', $reservation);
    }
}