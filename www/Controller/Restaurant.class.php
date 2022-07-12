<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\CreatePage;
use App\Core\View;
use App\Model\Content;
use App\Model\Page;
use App\Model\Restaurant as RestaurantModel;
use App\Model\Stock as StockModel;
use App\Core\MysqlBuilder;


class Restaurant
{

    // Récuperer tout les restaurants sur la page /restaurants
    public function restaurant()
    {
        session_start();
        unset($_SESSION["restaurant"]);
        $restaurant = new RestaurantModel();
        // utiliser la fonction getAllRestaurant() de RestaurantModel
        $allRestaurants = $restaurant->getAllRestaurants(['user_id' => $_SESSION["user"]["id"]]);
        $restaurantsIds = [];
        foreach ($allRestaurants as $restau) {
            array_push($restaurantsIds, $restau["id"]);
        }
        $_SESSION["restaurantsIds"] = $restaurantsIds;
        $view = new View("restaurants", 'back');
        $view->assign('title', 'Restaurants');
        $view->assign('restaurants', $allRestaurants);
        $view->assign('restaurant', $restaurant);
    }

    // Supprimer un restaurant depuis la page /restaurant/information
    public function deleteRestaurant()
    {
        session_start();
        if (!$_SESSION["restaurant"] || !$_SESSION["restaurant"]["id"]) {
            header('Location: /restaurants');
        }
        $restaurant = new RestaurantModel();
        $builder = new MysqlBuilder();
        $page = new Page();
        $currentRestaurant = $builder->select('restaurant', ["name", "favorite"])
            ->where('id', $_SESSION["restaurant"]["id"])
            ->fetchClass("restaurant")
            ->fetch();
        $currentRestaurant->setName($restaurant->removeAccents(strtolower($currentRestaurant->getName())));

        if($currentRestaurant->getFavorite() == 1){
            unset($_SESSION["favoriteRestaurant"]);
        }
        $restaurant->databaseDeleteOneRestaurant(["id" => $_SESSION["restaurant"]["id"]]);

        $dirname = $_SERVER["DOCUMENT_ROOT"] . '/View/pages/' .  $currentRestaurant->getName() . '/';
        $result = $page->deleteDirectory($dirname);
        unset($_SESSION["restaurant"]["id"]);
        header('Location: /restaurants');
    }

    // Formulaire update restaurant /restaurant/information
    public function getOneRestaurant()
    {
        session_start();
        $restaurant = new RestaurantModel();
        $oneRestaurant = $restaurant->getOneRestaurant($_SESSION["restaurant"]["id"]);
        $restaurant->hydrate($oneRestaurant);
        $view = new View("restaurant-info", "back");
        $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Informations');
        $view->assign('restaurant', $restaurant);
        $view->assign('oneRestaurant', $oneRestaurant);
    }

    // Creation du restaurant
    public function createOneRestaurant()
    {
        $restaurant = new RestaurantModel();
        $page = new Page();
        $errors = null;
        session_start();
        if (!empty($_POST) && $_POST["user_id"] == $_SESSION["user"]["id"]) {

            if (empty($_POST["favorite"])) {
                $_POST["favorite"] = 0;
            } else {
                $_POST["favorite"] = 1;
            }
            $_POST = array_map('htmlspecialchars', $_POST);
            $errors = Verificator::checkForm($restaurant->getCompleteRestaurantForm(), $_POST + $_FILES);

            if (!$errors) {

                $restaurant->hydrate($_POST);
                if ($_POST["favorite"] == 1) {
                    $restaurant->unfavoriteAllRestaurants();
                }
                $name = $restaurant->removeAccents(strtolower($restaurant->getName()));
                $dirname = $_SERVER["DOCUMENT_ROOT"] . '/View/pages/' .  $name . '/';
                $url = 'pages/' .  $name . '/index';
                if (!is_dir($dirname)) {
                    mkdir($dirname, 0755, true);
                    $fp = fopen('View/' . $url . '.view.php', 'w+');
                    $inputs['title'] = 'index';
                    $array_body[] = "Hello World";
                    (new \App\Core\CreatePage)->createBasicPageIndex($fp, $inputs, $array_body);
                    fclose($fp);
                }
                // $restaurant->setId(null);
                $restaurant->save();
                $restaurantId =  $restaurant->last()->id;
                if($restaurant->getFavorite() == 1) {
                   $_SESSION["favoriteRestaurant"] = $restaurantId;
                }

                $pageRestaurant = $restaurant->findOneBy(['name' => $restaurant->getName()]);
                $page->setTitle($inputs['title']);
                $page->setUrl($url);
                $page->setStatus(0);
                $page->setDisplayMenu(0);
                $page->setDisplayComments(0);
                $page->setIdRestaurant($pageRestaurant['id']);
                $page->save();
                $page = $page->findOneBy(['url' => $page->getUrl()]);
                $content = new Content();
                $content->setIdPage($page['id']);
                $content->setBody($array_body[0]);
                $content->save();

                $stock = new StockModel;
                $stock->hydrate(['restaurantId' => $restaurantId]);
                $stock->save();

                return header('Location: /restaurants');
            }
        }

        return header('Location: /restaurant/create');
    }

    // Validation update restaurant 
    public function updateRestaurant()
    {
        session_start();
        $restaurant = new RestaurantModel();
        $errors = null;
        $_SESSION["restaurant"]["folderName"] = $restaurant->removeAccents(strtolower($_SESSION["restaurant"]["name"]));
        $folderName = $_SESSION["restaurant"]["folderName"];
        if (!empty($_POST) && $_POST["id"] == $_SESSION["restaurant"]["id"]) {
            if (empty($_POST["favorite"])) {
                $_POST["favorite"] = 0;
            } else {
                $_POST["favorite"] = 1;
            }
            $_POST = array_map('htmlspecialchars', $_POST);
            $errors = Verificator::checkForm($restaurant->getCompleteUpdateRestaurantForm(), $_POST + $_FILES);
            if (!$errors) {
                $restaurant->hydrate($_POST);
                if ($_POST["favorite"] == 1) {
                    $restaurant->unfavoriteAllRestaurants();
                }
                $restaurant->save();
                $page = new Page();
                $builder = new MysqlBuilder();
                $newUrl = $restaurant->getName();
                $newUrl = $restaurant->removeAccents(strtolower($newUrl));
                $pageRestaurant = $builder->select('page', ["url"])
                    ->where('id_restaurant', $_SESSION["restaurant"]["id"])
                    ->fetchClass("page")
                    ->fetchAll();
                foreach($pageRestaurant as $page){
                     $builder->update('page', ['url' => str_replace('pages/' . $folderName .'/', 'pages/' . $newUrl . '/', $page->getUrl())])
                        ->where('id_restaurant', $_SESSION["restaurant"]["id"])
                        ->fetchClass('page')
                        ->execute();
                }
                $dirname = $_SERVER["DOCUMENT_ROOT"] . '/View/pages/' .  $folderName . '/';
                rename($dirname, $_SERVER["DOCUMENT_ROOT"] . '/View/pages/' .  $newUrl . '/');
                if ($restaurant->getFavorite() == 0) {
                    unset($_SESSION["favoriteRestaurant"]);
                } else {
                    $_SESSION["favoriteRestaurant"] = $restaurant->getId();
                }

                return header('Location: /restaurants');
            }
        }
        return header('Location: /restaurant/information');
    }

    // Formulaire de creation de restaurant /restaurant/create
    public function createRestaurantForm()
    {
        $restaurant = new RestaurantModel();
        $errors = null;
        $view = new View("create-restaurant", "back");
        $view->assign('title', 'Création restaurant');
        $view->assign('restaurant', $restaurant);
        $view->assign("errors", $errors);
    }

    // Page avec les options pour un restaurant /restaurant
    public function restaurantOptions()
    {
        session_start();
        $_POST = array_map('htmlspecialchars', $_POST);
        if (!in_array($_POST["id"], $_SESSION["restaurantsIds"])) {
            return header('Location: /restaurants');
        }
        $id = $_POST["id"];
        $_SESSION["restaurant"]["id"] = intval($id);
        $restaurant = new RestaurantModel();
        $oneRestaurant = $restaurant->getOneRestaurant($id);
        $_SESSION["restaurant"]["name"] = $oneRestaurant["name"];
        $builder = new MysqlBuilder();
        
        $stock = $builder->select("stock", ["id"])
            ->where("restaurantId", $_SESSION["restaurant"]["id"])
            ->fetchClass("stock")
            ->fetch();
        $_SESSION["stock"]["id"] = $stock->getId();
        $restaurant->hydrate($oneRestaurant);
        $view = new View("restaurant", "back");
        $view->assign('title', $_SESSION["restaurant"]["name"]);
        $view->assign('restaurant', $restaurant);
        $view->assign('oneRestaurant', $oneRestaurant);
    }
    public function QrcodeEdit()
    {
        session_start();
        $_SESSION['inputsQrcode'] = $_POST;

        $builder = new MysqlBuilder();

        $pageRestaurant = $builder->select('page', ["url"])
            ->where('id_restaurant', $_SESSION["restaurantsIds"][0])
            ->where('display_menu', 1)
            ->fetchClass("page")
            ->fetch();

        //Sans logo
        if (empty($_FILES["logo"]["name"])){
            $curl = curl_init();
            $urlqrcode = APP_URL . '%2Fpages%2F' . $_SESSION['restaurant']['name'] . '%2F' . $pageRestaurant->getUrl();
            curl_setopt_array($curl, [
                CURLOPT_URL => "https://qrcode3.p.rapidapi.com/generateQR?text=" . $urlqrcode .  '&inner_eye_style=' . $_SESSION["inputsQrcode"]["style_inner"] . '&style=' . $_SESSION["inputsQrcode"]["style"] . '&style_color=' . $_SESSION["inputsQrcode"]["color"] .  '&outer_eye_style=' .  $_SESSION["inputsQrcode"]["style_outer"],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: qrcode3.p.rapidapi.com",
                    "X-RapidAPI-Key: cabda91867mshb30fccb93e66b88p161593jsn9e28f5024f8a"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $fp = fopen('public/assets/img/qrcode/qrcode' . $_SESSION["restaurantsIds"][0] . '.svg', 'w+');
                fwrite($fp,$response);
                fclose($fp);
            }
        }else{
            //Avec logo
            $imageFileType = strtolower(pathinfo($_FILES["logo"]["name"],PATHINFO_EXTENSION));
            //Verification de l'extention du fichier
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "svg" ) {

                $restaurant = $builder
                    ->select('restaurant', ["*"])
                    ->where("id", $_SESSION["restaurant"]["id"])
                    ->fetchClass("restaurant")
                    ->fetch();
                $allCartes = $builder
                    ->select('carte', ["*"])
                    ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                    ->fetchClass("carte")
                    ->fetchAll();
                $allCartesIds = [];
                foreach ($allCartes as $value) {
                    array_push($allCartesIds, $value->getId());
                }

                $view = new View('cartes', 'back');
                $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Cartes');
                $view->assign('cartes', $allCartes);
                $view->assign('restaurant', $restaurant);
                $view->setFlashMessage('error', 'Les extensions autorisées sont jpg, jpeg, png, svg');
                die();
            }

            // Check si le fichier poster est une image ou non
            $check = getimagesize($_FILES["logo"]["tmp_name"]);
            if($check == false) {
                $restaurant = $builder
                    ->select('restaurant', ["*"])
                    ->where("id", $_SESSION["restaurant"]["id"])
                    ->fetchClass("restaurant")
                    ->fetch();
                $allCartes = $builder
                    ->select('carte', ["*"])
                    ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                    ->fetchClass("carte")
                    ->fetchAll();
                $allCartesIds = [];
                foreach ($allCartes as $value) {
                    array_push($allCartesIds, $value->getId());
                }

                $view = new View('cartes', 'back');
                $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Cartes');
                $view->assign('cartes', $allCartes);
                $view->assign('restaurant', $restaurant);
                $view->setFlashMessage('error', 'Le fichier poster n\'est pas une image');
                die();
            }
            //Check sur la taille du fichier
            if ($_FILES["logo"]["size"] > 2097152) {
                $restaurant = $builder
                    ->select('restaurant', ["*"])
                    ->where("id", $_SESSION["restaurant"]["id"])
                    ->fetchClass("restaurant")
                    ->fetch();
                $allCartes = $builder
                    ->select('carte', ["*"])
                    ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                    ->fetchClass("carte")
                    ->fetchAll();
                $allCartesIds = [];
                foreach ($allCartes as $value) {
                    array_push($allCartesIds, $value->getId());
                }

                $view = new View('cartes', 'back');
                $view->assign('title', $_SESSION["restaurant"]["name"] . ' - Cartes');
                $view->assign('cartes', $allCartes);
                $view->assign('restaurant', $restaurant);
                $view->setFlashMessage('error', 'Votre fichier est trop lour, la limite de taille est 2MB');
                die();
            }
            $dirname = $_SERVER["DOCUMENT_ROOT"] . '/public/assets/img/qrcode/';
            if (!is_dir($dirname)) {
                mkdir($dirname, 0755, true);
            }

            move_uploaded_file($_FILES["logo"]["tmp_name"], 'public/assets/img/qrcode/logo.png');

            $_SESSION["inputsQrcode"]["color"] = str_replace('#', '%23',$_SESSION["inputsQrcode"]["color"] );


            if ($_SESSION['inputsQrcode'])

                $curl = curl_init();
            $urlqrcode = APP_URL . '%2Fpages%2F' . $_SESSION['restaurant']['name'] . '%2F' . $pageRestaurant->getUrl();
            curl_setopt_array($curl, [                                                                                                                                                                                                                                                  //Mettre    public/assets/img/qrcode/logo en prod
                CURLOPT_URL => "https://qrcode3.p.rapidapi.com/generateQR?text=" . $urlqrcode .  '&inner_eye_style=' . $_SESSION["inputsQrcode"]["style_inner"] . '&style=' . $_SESSION["inputsQrcode"]["style"] . '&style_color=' . $_SESSION["inputsQrcode"]["color"] . '&image=' . 'https%3A%2F%2Fupload.wikimedia.org%2Fwikipedia%2Fcommons%2F4%2F47%2FPNG_transparency_demonstration_1.png' .  '&outer_eye_style=' .  $_SESSION["inputsQrcode"]["style_outer"],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: qrcode3.p.rapidapi.com",
                    "X-RapidAPI-Key: cabda91867mshb30fccb93e66b88p161593jsn9e28f5024f8a"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $fp = fopen('public/assets/img/qrcode/qrcode' . $_SESSION["restaurantsIds"][0] . '.svg', 'w+');
                fwrite($fp,$response);
                fclose($fp);
            }
        }

        return header('Location: /restaurant/cartes');
    }
}
