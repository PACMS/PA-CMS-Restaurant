<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Page as PageModel;

class Page
{

    public function index(){
        $pages = new PageModel();
        $idrestaurant = $_POST["id"];
        $pages = $pages->getAllPagesFromRestaurant($idrestaurant) ;
        $view = new View('page', 'back');
        $view->assign('pages', $pages);
        $view->assign('idrestaurant', $idrestaurant);
    }
    public function createPage(){
        $view = new View('pagecreate', 'back');

    }
}