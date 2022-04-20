<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Restaurant as RestaurantModel;

class Restaurant
{
    public function restaurant ()
    {
        $restaurant = new RestaurantModel();
        // utiliser la fonction getAllRestaurant() de RestaurantModel
         $allRestaurants = $restaurant->getAllRestaurants();
        $view = new View("restaurants");
        $view->assign('restaurant', $allRestaurants);
        
        
    }

    public function updateRestaurant ()
    {
        $restaurant = new RestaurantModel();
        $errors = null;

        if (!empty($_POST)) {
            $errors = Verificator::checkForm($restaurant->getCompleteRegisterForm(), $_POST + $_FILES);

            if(!$errors) {
                $restaurant->hydrate($_POST);
                $restaurant->save();
            }
        }

        $view = new View("profile-restaurant");
        $view->assign('restaurant', $restaurant);
        $view->assign("errors", $errors);
    }
}