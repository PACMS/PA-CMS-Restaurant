<?php

namespace App\Controller;

use App\Core\View;

class Main
{
    public function home()
    {
        $view = new View("home");
        
    }


    public function contact()
    {
        $view = new View("contact");
    }
}
