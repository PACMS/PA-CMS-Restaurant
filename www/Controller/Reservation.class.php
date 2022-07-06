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
        $_SESSION['id_restaurant'] = $_POST["id"];
        $reservation = new ReservationModel();
        $data =  $reservation->getAllReservationsFromRestaurant($_SESSION['id_restaurant'] );
        foreach ($data as $dateReserv ){
            $dateReserv['date'] = date("d/m/Y", strtotime($dateReserv['date']));
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
        $reservation->setIdRestaurant($_SESSION['id_restaurant']);
        $reservation->save();
        $data =  $reservation->getAllReservationsFromRestaurant($_SESSION['id_restaurant'] );

        $view = new View("reservation", "back", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' !');
        $view->assign('reservation', $reservation);
        $view->assign('data', $data);

    }
    public function edit()
    {
        $arrayuri = explode( '=', $_SERVER['REQUEST_URI']) ;
        $idReservation = $arrayuri[1];

        $reservation = new ReservationModel();


        $reservation->hydrate($_POST);
        $clientName = $reservation->getName();
        $reservation->setId($idReservation);

        $reservation->setName($reservation->getName());
        $reservation->setDate($reservation->getDate());
        $reservation->setHour($reservation->getHour());
        $reservation->setNumPerson($reservation->getNumPerson());
        $reservation->setNumTable($reservation->getNumTable());
        $reservation->setPhoneReserv($reservation->getPhoneReserv());
        $reservation->save();
        $data =  $reservation->getAllReservationsFromRestaurant($_SESSION['id_restaurant'] );

        $view = new View("reservation", "back", 'success', 'Reservation', 'Modification avec succès de la reservation de ' . $clientName . ' !');
        $view->assign('reservation', $reservation);
        $view->assign('data', $data);
    }

    public function delete()
    {
        $arrayuri = explode( '=', $_SERVER['REQUEST_URI']) ;
        $idReservation = $arrayuri[1];
        $reservation = new ReservationModel();

        $reservation->databaseDeleteOneReservation(["id" => $idReservation]);
        $data =  $reservation->getAllReservationsFromRestaurant($_SESSION['id_restaurant'] );

        $view = new View("reservation", "back", 'success', 'Reservation', 'Suppression de la reservation de ' . $clientName . ' avec succès !');
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
