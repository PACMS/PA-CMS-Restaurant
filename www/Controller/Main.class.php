<?php

namespace App\Controller;

use App\Core\View;
use App\Core\MysqlBuilder;

class Main
{
    public function home()
    {
        if (@is_null($_SESSION['user'])) {
            $builder = new MysqlBuilder();
            $pages = $builder->select("page p", ["*"])
                            ->rightJoin('restaurant r', "r.id", "p.id_restaurant")
                            ->fetchClass("page")
                            ->fetchAll();
            $view = new View("home");
            $view->assign("pages", $pages);
        } else {
            header("Location: /dashboard");
        }
    }


    public function contact()
    {
        $view = new View("contact");
    }
}
