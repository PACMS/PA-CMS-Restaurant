<?php

namespace App\Controller;

use App\Core\View;

class Admin{


    public function home()
    {
        //Connecté à la bdd
        //j'ai récup le prenom
        $firstname = "Yves";

        $view = new View("dashboard", "back");
        $view->assign("firstname", $firstname);
        $view->assign("lastname", "SKRZYPCZYK");
    }


}