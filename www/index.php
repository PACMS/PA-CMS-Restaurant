<?php
namespace App;



require "conf.inc.php";

function myAutoloader( $class )
{
    // var_dump($class);
    // $class -> "Core\Security" "Model\User
    $class = str_ireplace("App\\","",$class);
    // $class -> "Core/Security" "Model/User
    $class = str_replace("\\","/",$class);
    // $class -> "Core/Security"
    if(file_exists($class.".class.php")){
        include $class.".class.php";
    }elseif (file_exists($class.".php")){
        require $class.".php";
    }
}

spl_autoload_register("App\myAutoloader");

use App\Core\Security;

$fileRoutes = "routes.yml";

if(file_exists($fileRoutes)){
    $routes = yaml_parse_file($fileRoutes);
}else{
    die("Le fichier de routing n'existe pas");
}




if (strpos($_SERVER["REQUEST_URI"], '?')) $uri = substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], '?'));
else $uri = $_SERVER["REQUEST_URI"];
// var_dump($routes);

if(empty($routes[$uri]) || empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])){
    header('Location: /notFound');
}


if(!Security::checkRoute($routes[$uri])){
    die("NotAuthorized");
}


$controller = ucfirst(strtolower($routes[$uri]["controller"]));
$action = strtolower($routes[$uri]["action"]);




// $uri = /login
// $Controller = User
// $action = login

$controllerFile = "Controller/".$controller.".class.php";
if(!file_exists($controllerFile)){
    die("Le fichier Controller n'existe pas");
}

include $controllerFile;

$controller = "App\\Controller\\".$controller;
if( !class_exists($controller)){
    die("La classe n'existe pas");
}

$objectController = new $controller();


if( !method_exists($objectController, $action) ){
    die("La methode n'existe pas");
}

$objectController->$action();
