<?php

namespace App\Controller;

use App\Core\View;

class Error
{
    public function home()
    {
        $view = new View("404", "back");
    }
}
