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
        $protocol = $_SERVER['REQUEST_SCHEME'];
        $domain = $_SERVER['HTTP_HOST'];
        $pages = new PageModel();
        $pages = $pages->getAllPagesFromRestaurant($_SESSION["restaurant"]["id"]);
        $view = new View('page', 'back');
        $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Pages');
        $view->assign('pages', $pages);
        $view->assign('protocol', $protocol);
        $view->assign('domain', $domain);
        $view->assign('idrestaurant', $_SESSION["restaurant"]["id"]);
    }
    public function createPage()
    {
        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $id_restaurant = $arrayuri[1];
        $view = new View('pagecreate', 'back');
        $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Création d\'une page');
        $view->assign('id_restaurant', $id_restaurant);
    }
    public function savePage()
    {
        $array_body = $_POST;
        $inputs = array_splice($array_body, 0, 2);
        // $array_body = array_shift($inputs);

        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $id_restaurant = $arrayuri[1];
        $builder = new MysqlBuilder();
        $restaurant = new Restaurant();

        $restaurant = $builder->select('restaurant', ["*"])
            ->where("id", $id_restaurant)
            ->fetchClass("restaurant")
            ->fetch();
        $restaurant->getName();
        $name = $restaurant->removeAccents(strtolower($restaurant->getName()));
        $inputName = $restaurant->removeAccents(strtolower($inputs['name']));
        $inputs["name"] = htmlentities($inputs["name"]);
        $inputs["title"] = htmlentities($inputs["title"]);
        $url = 'pages/' . $name . '/' . $inputName;
        if ($_POST["displayMenu"]) {
            if (file_exists('public/assets/img/qrcode/qrcode' . $id_restaurant . '.svg') == true){
                $view = new View('pagecreate', 'back');
                $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Création d\'une page');
                $view->assign('id_restaurant', $id_restaurant);
                $view->setFlashMessage('error', 'Une page Carte existe déjà');
                die();
            }
            $curl = curl_init();
            $urlqrcode = APP_URL . '%2F' . $url ;

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://qrcode3.p.rapidapi.com/generateQR?text=" . $urlqrcode,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: qrcode3.p.rapidapi.com",
                    "X-RapidAPI-Key: API_KEY"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $fp = fopen('public/assets/img/qrcode/qrcode' . $id_restaurant . '.svg', 'w+');
                fwrite($fp,$response);
                fclose($fp);
            }
        }

        $fp = fopen('View/' . $url . '.view.php', 'w+');
        (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $array_body, $id_restaurant);
        fclose($fp);
        $page = new PageModel();
        $page->setTitle($inputs['title']);
        $page->setUrl($url);
        $page->setStatus(0);
        $page->setDisplayMenu($_POST["displayMenu"]);
        $page->setDisplayComments($_POST["displayComment"]);
        $page->setDisplayReservations($_POST["displayReservation"]);
        $page->setIdRestaurant($id_restaurant);
        $page->save();
        $page = $page->findOneBy(['url' => $page->getUrl()]);
        
        foreach ($array_body as $key => $body) {
            if(str_contains($key, "body")){
                $content = new Content();
                $content->setIdPage($page['id']);
                $content->setBody($body);
                $content->save();
           }
        }

        header('Location: /restaurant/page');
    }
    public function delete()
    {
        session_start();

        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $idPage = $arrayuri[1];
        $builder = new MysqlBuilder();

        $page = new PageModel();
        $page = $builder->select("page", ["display_menu", "url"])
            ->where("id",  $idPage)
            ->fetchClass("page")
            ->fetch();
        if ($page->getDisplayMenu()){
            //d($_SESSION);
            unlink('public/assets/img/qrcode/qrcode' . $_SESSION['restaurant']['id'] . '.svg');
        }
        unlink('View/' . $page->getUrl() . '.view.php');

        $page = $builder->delete("page", ["id" => $idPage])

            ->fetchClass("page")
            ->fetch();

        $this->refreshPages();

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
        $view = new View('showPage', 'back');
        $view->assign('page', $page);
        $view->assign('contents', $content);
    }

    public function edit()
    {
        $array_body = $_POST;
        $inputs = array_splice($array_body, 0, 1);
        $arrayuri = explode('=', $_SERVER['REQUEST_URI']);
        $id_page = $arrayuri[1];
        $inputs["title"] = htmlentities($inputs["title"]);
        $restaurant = new Restaurant();
        $page = new PageModel();
        $page = $page->findOneBy(['id' => $id_page]);
        $page["url"] = $restaurant->removeAccents(strtolower($page["url"]));
        unlink('View/' . $page['url'] . '.view.php');
        $fp = fopen('View/' . $page['url'] . '.view.php', 'w+');
        (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $array_body, $page['id_restaurant']);
        //dd($page['title']);
        $pageUpdate = new PageModel();
        $pageUpdate->setId($page['id']);
        $pageUpdate->setTitle($inputs['title']);
        $pageUpdate->setUrl($page['url']);
        $pageUpdate->setStatus(0);
        $pageUpdate->setDisplayMenu($_POST["displayMenu"]);
        $pageUpdate->setDisplayComments($_POST["displayComment"]);
        $pageUpdate->setDisplayReservations($_POST["displayReservation"]);
        $pageUpdate->setIdRestaurant($page['id_restaurant']);
        $pageUpdate->save();

        foreach ($array_body as $key => $body) {
            if(str_contains($key, "body")){

                $contentId = substr($key, 4);
                $content = new Content();
                $content->setId($contentId);
                $content->setBody($body);
                $content->save();
            }
        }

        header('Location: /restaurant/page');
    }

    public function refreshPages()
    {
        $builder = new MysqlBuilder();
        $pages = $builder->select("page", ["*"])
            ->where("id_restaurant", $_SESSION["restaurant"]["id"])
            ->fetchClass("page")
            ->fetchAll();

        $content = [];
        $inputs = [];
        foreach($pages as $page) {
            if (file_exists('View/' . $page->getUrl() . '.view.php')) {
                $fp = fopen('View/' . $page->getUrl() . '.view.php', 'w+');
                $content["displayMenu"] = $page->getDisplayMenu();
                $content["displayComment"] = $page->getDisplayComments();
                $inputs["title"] = $page->getTitle();
                $contents = $builder->select("content", ["*"])
                    ->where("id_page", $page->getId())
                    ->fetchClass("content")
                    ->fetchAll();
                foreach($contents as $contentValue) {
                    $content["body{$contentValue->getId()}"] = $contentValue->getBody();
                }
                (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $content, $page->getIdRestaurant());
            }
        }
    }
}
