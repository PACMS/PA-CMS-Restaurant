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
        $data =  $reservation->getAll();
        foreach ($data as $dateReserv ){
            $dateReserv->date = date("d/m/Y", strtotime($dateReserv->date));
        }

        //die(print_r($data[3]->date));
        $view = new View("reservation", "back");
        $view->assign('reservation', $reservation);
        $view->assign('data', $data);

    }

    public function addReservation()
    {
        $reservation = new ReservationModel();

        //Verificator::checkForm($reservation->getModalForm(), $_POST + $_FILES);

        $reservation->hydrate($_POST);
        $reservation->save();
        header('Location:/reservation');

    }
}