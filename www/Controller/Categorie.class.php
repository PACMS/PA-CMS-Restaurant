<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Core\MysqlBuilder;
use App\Model\Categorie as CategorieModel;
use App\Model\Meal as MealModel;

class Categorie
{

    public function createcategorie()
    {
        $errors = null;
        $_POST = array_map('htmlspecialchars', $_POST);
        $queryBuilder = new MysqlBuilder();
        $categorie = new CategorieModel();
        $errors = Verificator::checkForm($categorie->getAddCategorie(), $_POST + $_FILES);
        if (!$errors) {
            $categorie->hydrate($_POST);
            $categorie->save();
        }

        (new \App\Controller\Page)->refreshPages();
        header('Location: /restaurant/carte/meals');
    }

    public function updateCategorie()
    {
        session_start();
        $errors = null;
        $_POST = array_map('htmlspecialchars', $_POST);
        $categorie = new CategorieModel();
        $errors = Verificator::checkForm($categorie->getUpdateCategorie(), $_POST + $_FILES);
        if (!$errors) {
            $categorie->hydrate($_POST);    
            $categorie->save();
        }

        (new \App\Controller\Page)->refreshPages();
        header('Location: /restaurant/carte/meals');
    }

    public function deleteCategorie()
    {
        $categorie = new CategorieModel();
        $categorie->deleteCategorie($_POST["id"]);
        (new \App\Controller\Page)->refreshPages();
    }

}
