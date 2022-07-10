<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Content;
use App\Model\Page as PageModel;
use App\Model\Restaurant;
use App\Core\MysqlBuilder;

class Page
{

    public function index()
    {
        session_start();
        $pages = new PageModel();
        $pages = $pages->getAllPagesFromRestaurant($_SESSION["restaurant"]["id"]);
        $view = new View('page', 'back');
        $view->assign('pages', $pages);
        $view->assign('idrestaurant', $_SESSION["restaurant"]["id"]);
    }
    public function createPage()
    {
        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $id_restaurant = $arrayuri[1];
        $view = new View('pagecreate', 'back');
        $view->assign('id_restaurant', $id_restaurant);
    }
    public function savePage()
    {
        $array_body = $_POST;
        $inputs = array_splice($array_body, 0, 2);
        // $array_body = array_shift($inputs);

        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $id_restaurant = $arrayuri[1];

        $restaurant = new Restaurant();
        $builder = new MysqlBuilder();
        $restaurant = $builder->select('restaurant', ["*"])
            ->where("id", $id_restaurant)
            ->fetchClass("restaurant")
            ->fetch();
        $restaurant->getName();
        $name = $restaurant->removeAccents(strtolower($restaurant->getName()));
        $inputName = $restaurant->removeAccents(strtolower($inputs['name']));

        $url = 'pages/' . $name . '/' . $inputName;
        
        $fp = fopen('View/' . $url . '.view.php', 'w+');
        (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $array_body);
        fclose($fp);
        $page = new PageModel();
        $page->setTitle($inputs['title']);
        $page->setUrl($url);
        $page->setStatus(0);
        $page->setDisplayMenu($_POST["displayMenu"]);
        $page->setDisplayComments($_POST["displayComment"]);
        $page->setIdRestaurant($id_restaurant);
        $page->save();
        $page = $page->findOneBy(['url' => $page->getUrl()]);
        foreach ($array_body as $body) {
            $content = new Content();
            $content->setIdPage($page['id']);
            $content->setBody($body);
            $content->save();
        }

        header('Location: /restaurant/page');
    }
    public function delete()
    {
        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $idPage = $arrayuri[1];
        $page = new PageModel();
        $page->databaseDeleteOnePage(["id" => $idPage]);
        header('Location: /restaurant/page');
    }
    public function showPage()
    {

        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $idPage = $arrayuri[1];
        $page = new PageModel();
        $page = $page->findOneBy(['id' => $idPage]);
        $content = new Content();
        $content = $content->getAllContentsFromIdPage($idPage);
        $view = new View('showpage', 'back');
        $view->assign('page', $page);
        $view->assign('contents', $content);
    }

    public function edit()
    {
        $array_body = $_POST;
        $inputs = array_splice($array_body, 0, 1);
        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $id_page = $arrayuri[1];
        $restaurant = new Restaurant();
        $page = new PageModel();
        $page = $page->findOneBy(['id' => $id_page]);
        $page["url"] = $restaurant->removeAccents(strtolower($page["url"]));
        unlink('View/' . $page['url'] . '.view.php');
        $fp = fopen('View/' . $page['url'] . '.view.php', 'w+');
        (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $array_body);
        //dd($page['title']);
        $pageUpdate = new PageModel();
        $pageUpdate->setId($page['id']);
        $pageUpdate->setTitle($inputs['title']);
        $pageUpdate->setUrl($page['url']);
        $pageUpdate->setStatus(0);
        $pageUpdate->setDisplayMenu($_POST["displayMenu"]);
        $pageUpdate->setDisplayComments($_POST["displayComment"]);
        $pageUpdate->setIdRestaurant($page['id_restaurant']);
        $pageUpdate->save();

        foreach ($array_body as $key => $body) {
            $contentId = substr($key, 4);
            $content = new Content();
            $content->setId($contentId);
            $content->setBody($body);
            $content->save();
        }
        header('Location: /restaurant/page');
    }
}
