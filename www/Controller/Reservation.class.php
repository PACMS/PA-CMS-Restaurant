<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Reservation as ReservationModel;
use App\Core\MysqlBuilder;
// use Comment controller
use App\Controller\Comment;
use Couchbase\MutationState;


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
        $data =  $reservation->getAllReservationsFromRestaurant(["id_restaurant" => $_SESSION['restaurant']["id"], "status" => '0'  ]);
        foreach ($data as $dateReserv) {
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
        $data =  $reservation->getAllReservationsFromRestaurant(["id_restaurant" =>$_SESSION['restaurant']["id"]]);
        header("Location: /restaurant/reservation");
        // $view = new View("reservation", "back", 'success', 'Reservation', 'Création avec succès de la reservation de ' . $clientName . ' !');
        // $view->assign('reservation', $reservation);
        // $view->assign('data', $data);

    }
    public function edit()
    {
        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $idReservation = $arrayuri[1];

        $reservation = new ReservationModel();


        $reservation->hydrate($_POST);

        // $clientName = $reservation->getName();
        $reservation->setId($idReservation);

        $reservation->setName($reservation->getName());
        $reservation->setDate($reservation->getDate());
        $reservation->setHour($reservation->getHour());
        $reservation->setNumPerson($reservation->getNumPerson());
        $reservation->setNumTable($reservation->getNumTable());
        $reservation->setPhoneReserv($reservation->getPhoneReserv());
        $reservation->save();
        return header("Location: /restaurant/reservation");
        // $view = new View("reservation", "back", 'success', 'Reservation', 'Modification avec succès de la reservation de ' . $clientName . ' !');
        // $view->assign('reservation', $reservation);
        // $view->assign('data', $data);
    }

    public function delete()
    {
        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);

        $idReservation = $arrayuri[1];
        $reservation = new ReservationModel();
        $builder = new MysqlBuilder();

        $allReservations = $builder->select('reservation', ["id"])
            ->where("id_restaurant", $_SESSION['restaurant']["id"])
            ->fetchClass("reservation")
            ->fetchAll();
        $reservationIds = [];
        foreach ($allReservations as $reservation) {
            array_push($reservationIds, $reservation->getId());
        }
        if (!in_array($idReservation, $reservationIds)) {
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
        if (is_null($_SESSION["restaurant"]["id"])) {
            $idRestaurant = $_SESSION['favoriteRestaurant'];
        } else {
            $idRestaurant = $_SESSION["restaurant"]["id"];
        }
        $test->mailAskForComment($currentReservation->getEmail(), $currentReservation->getName(), $idRestaurant);
    }

    public function reservationTable()
    {
        $view = new View('table-reservation', 'front');
        $view->assign('reservation', new ReservationModel());
    }

    public function addReservationTable()
    {
        $reservation = new ReservationModel();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($reservation->getTableReservationForm(), $_POST);

            if (!$errors) {
                $_POST['status'] = 0;
                $_POST['idRestaurant'] = $_SESSION['restaurant']['id'];
                $_POST = array_map('htmlspecialchars', $_POST);
                $reservation->hydrate($_POST);
                $clientName = $reservation->getName();
                $nbPerson = $reservation->getNumPerson();
                $date = $reservation->getDate();
                $hour = $reservation->getHour();
                $email = $reservation->getEmail();
                $reservation->save();

                $view = new View("successReservation");
                $view->assign('reservation', $reservation);
                $view->assign('errors', $errors);
                $this->tempMailReservation($clientName, $date, $hour, $nbPerson, $email);
            }
        } else die('erreur');
    }

    public function confirmValidation (int $id)
    {
        (new MysqlBuilder())->update('reservation', ['confirmation' => true])->where('id', $id)->execute();
        $reservation = (new MysqlBuilder())->select('reservation', ['*'])->where('id', htmlentities($id))->fetchClass('reservation')->fetch();

        $mail = new Mail();
        $mail->confirmMailReservation($reservation->getName(), $reservation->getDate(), $reservation->getHour(), $reservation->getNumPerson(), $reservation->getEmail());

        header('Location: /restaurant/reservation');
    }

    public function tempMailReservation (string $name, string $date, string $hour, string $nbPerson, string $email)
    {
        $mail = new Mail();
        $mail->tempMailReservation($name, $date, $hour, $nbPerson, $email);
    }

    public function getReservationsStats()
    {
        $builder = new MysqlBuilder();
        // à mettre en param en dessous ["id_restaurant" => $_SESSION["restaurant"]["id"]]
        if(!empty($_SESSION["restaurant"]["id"])){

            $data =  $builder->select("reservation", ["*"])
            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
            ->fetchClass("reservation")
            ->fetchAll();
        }else{
            $restaurant = $builder->select("restaurant", ["id"])
            ->where("favorite", "1")
            ->fetchClass("restaurant")
            ->fetch();
            if($restaurant != false){
                $data =  $builder->select("reservation", ["*"])
                ->where("id_restaurant", $restaurant->getId())
                ->fetchClass("reservation")
                ->fetchAll();
            }
        }
        $nbReservations = [];
        for($i = 0; $i < 15; $i++) {
            $theDate = new \DateTime();
            $nb = 0;
            $formatedDate = $theDate->modify('+' . $i .  'day')->format('Y-m-d');
            foreach($data as $value) {

                 if($value->getDate() == $formatedDate) {
                    $nb++;
                 }
            }
            array_push($nbReservations, $nb);
        }
        return $nbReservations;
    }
}
