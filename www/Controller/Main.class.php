<?php

namespace App\Controller;

use App\Core\View;

class Main{

    public function home()
    {
        echo "Welcome";
    }


    public function contact()
    {
        $view = new View("contact");
    }
}