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
        $data =  $reservation->getAllReservationsFromRestaurant($_SESSION['restaurant']["id"] );
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
        $_POST = array_map('htmlspecialchars', $_POST);
        $_POST["status"] = 0;
        if ($_POST["status"] != 0) {
            header("Location: /restaurant/reservation");
        }
        $reservation->hydrate($_POST);
        $clientName = $reservation->getName();
        $reservation->setIdRestaurant($_SESSION['restaurant']["id"]);
        $reservation->save();
        $data =  $reservation->getAllReservationsFromRestaurant($_SESSION['restaurant']["id"] );
        header("Location: /restaurant/reservation");
        // $view = new View("reservation", "back", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' !');
        // $view->assign('reservation', $reservation);
        // $view->assign('data', $data);

    }
    public function edit()
    {
        $arrayuri = explode( '=', $_SERVER['REQUEST_URI']) ;
        $idReservation = $arrayuri[1];

        $reservation = new ReservationModel();


        $reservation->hydrate($_POST);
        dd($reservation);
        // $clientName = $reservation->getName();
        $reservation->setId($idReservation);

        $reservation->setName($reservation->getName());
        $reservation->setDate($reservation->getDate());
        $reservation->setHour($reservation->getHour());
        $reservation->setNumPerson($reservation->getNumPerson());
        $reservation->setNumTable($reservation->getNumTable());
        $reservation->setPhoneReserv($reservation->getPhoneReserv());
        $reservation->save();
        return header("Location: /reservation");
        // $view = new View("reservation", "back", 'success', 'Reservation', 'Modification avec succès de la reservation de ' . $clientName . ' !');
        // $view->assign('reservation', $reservation);
        // $view->assign('data', $data);
    }

    public function delete()
    {
        $arrayuri = explode( '=', $_SERVER['REQUEST_URI']) ;
        
        $idReservation = $arrayuri[1];
        $reservation = new ReservationModel();
        $builder = new MysqlBuilder();

        $allReservations = $builder->select('reservation', ["id"])
                        ->where("id_restaurant", $_SESSION['restaurant']["id"])
                        ->fetchClass("reservation")
                        ->fetchAll();
        $reservationIds = [];
        foreach($allReservations as $reservation){
                array_push($reservationIds, $reservation->getId());
        }
        if(!in_array($idReservation, $reservationIds)){
            header("Location: /restaurant/reservation");
        }
        $builder->delete('reservation', ['id' => $idReservation])
            ->fetchClass('reservation')
            ->execute();
        header("Location: /restaurant/reservation");
        // $view = new View("reservation", "back", 'success', 'Reservation', 'Suppression de la reservation de ' . $clientName . ' avec succès !');
        // $view->assign('reservation', $reservation);
        // $view->assign('data', $data);

    }

    public function addReservationClient()
    {
        $reservation = new ReservationModel();
        $_POST = array_map('htmlspecialchars', $_POST);
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
        $_POST = array_map('htmlspecialchars', $_POST);
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

    public function getReservationsStats()
    {
        $reservation = new ReservationModel();
        // à mettre en param en dessous ["id_restaurant" => $_SESSION["restaurant"]["id"]]
        $data =  $reservation->getAllReservation();
        return $data;
    }
}
