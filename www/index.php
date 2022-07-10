<?php

namespace App;

require "Core/Helpers.php";

function myAutoloader($class)
{
    // var_dump($class);
    // $class -> "Core\Security" "Model\User
    $class = str_ireplace("App\\", "", $class);
    // $class -> "Core/Security" "Model/User
    $class = str_replace("\\", "/", $class);
    // $class -> "Core/Security"
    if (file_exists($class . ".class.php")) {
        include $class . ".class.php";
    } elseif (file_exists($class . ".php")) {
        include $class . ".php";
    }
}

spl_autoload_register("App\myAutoloader");

use App\Core\Security;
use App\Model\Option as OptionModel;
use App\Model\Theme as ThemeModel;
use App\Core\View;
use App\Model\Page;

if (file_exists('conf.inc.php')) {
    require "conf.inc.php";
} else {
    $_SERVER["REQUEST_URI"] = "/setup";
}

$option = new OptionModel();
$idTheme = $option->getOptionByName('theme')['value'];
$theme = new ThemeModel();
$currentTheme = $theme->getThemeById($idTheme);

if (!isset($_SESSION)) {
    session_start(
        [
            'cookie_lifetime' => 86400,
            'read_and_close' => true
        ]
    );
    $_SESSION['theme'] = $currentTheme;
}

$fileRoutes = "routes.yml";

if (file_exists($fileRoutes)) {
    $routes = yaml_parse_file($fileRoutes);
} else {
    die("Le fichier de routing n'existe pas");
}

if (strpos($_SERVER["REQUEST_URI"], '?')) {
    $uri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], '?'));
} else {
    $uri = $_SERVER["REQUEST_URI"];
}

$uribdd = substr($uri ,1);
$uriPage = new Page();
$uriPage = $uriPage->findOneBy(['url' => $uribdd]);

if (!$uriPage){
    
    foreach ($routes as $key => $route) {
        if (strpos($key, ':')) {
            if (substr($key, 0, strpos($key, ':')) == substr($_SERVER["REQUEST_URI"], 0, strpos($key, ':'))) {
                $param = substr($_SERVER["REQUEST_URI"], strpos($key, ':'));
                $uri = $key;
            }
        }
    }

    if (empty($routes[$uri]) || empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])) {
        http_response_code(404);
        new View('error404');
    }
    
    if (isset($routes[$uri]["security"]) && !Security::checkRoute($routes[$uri])) {
        http_response_code(401);
        die("401 : Unauthorized");
    }

    $controller = ucfirst($routes[$uri]["controller"]);
    $action = strtolower($routes[$uri]["action"]);

    $controllerFile = "Controller/" . $controller . ".class.php";
    if (!file_exists($controllerFile)) {
        die("Le fichier Controller n'existe pas");
    }
    
    require $controllerFile;
    
    $controller = "App\\Controller\\" . $controller;
    if (!class_exists($controller)) {
        die("La classe n'existe pas");
    }
    
    $objectController = new $controller();
    
    if (!method_exists($objectController, $action)) {
        die("La methode n'existe pas");
    }

    isset($param) ? $objectController->$action($param) : $objectController->$action();
}else{
    $view = new View($uribdd);
    $view->assign('title', $uriPage['title']);
}
