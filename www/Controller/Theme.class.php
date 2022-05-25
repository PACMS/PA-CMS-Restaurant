<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Theme as Template;

class Theme
{
    public function render ()
    {
        new View('theme');
    }

    public function home (int $id)
    {
        new Template('home');
    }

    public function story (int $id)
    {
        new Template('story');
    }

    public function menu (int $id)
    {
        new Template('menu');
    }

    public function reservation (int $id)
    {
        new Template('reservation');
    }

    public function contact (int $id)
    {
        new Template('contact');
    }
}