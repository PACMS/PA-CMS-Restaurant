<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Page as PageModel;
use App\Model\Restaurant;

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
        $arrayuri = explode( '=', $_SERVER['REQUEST_URI']) ;
        $id_restaurant = $arrayuri[1];
        $view = new View('pagecreate', 'back');
        $view->assign('id_restaurant', $id_restaurant);

    }
    public function savePage(){
        $array_body = $_POST;
        $inputs = array_splice($array_body ,0,2) ;
       // $array_body = array_shift($inputs);

        $arrayuri = explode( '=', $_SERVER['REQUEST_URI']) ;
        $id_restaurant = $arrayuri[1];

        $restaurant = new Restaurant();
        $restaurant = $restaurant->findOneBy(['id' => $id_restaurant]);
        $url = 'pages/' . $restaurant['name'] . '/' . $inputs['name'];
        $fp = fopen('View/' . $url . '.view.php', 'w+');
        (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $array_body);
        $page = new PageModel();
        $page->setUrl($url);
        $page->setStatus(0);
        $page->setIdRestaurant($id_restaurant);

        $page->save();
        header('Location: /restaurants');

    }
}