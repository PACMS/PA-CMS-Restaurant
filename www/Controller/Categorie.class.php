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
        $queryBuilder = new MysqlBuilder();
        $categorie = new CategorieModel();
        $categorie->hydrate($_POST);
        $categorie->save();

        header('Location: /carte/meals');
    }

    public function updateCategorie()
    {
        $categorie = new CategorieModel();
        $categorie->hydrate($_POST);
        $categorie->save();

        header('Location: /carte/meals');
    }

    public function deleteCategorie()
    {
        $categorie = new CategorieModel();
        $categorie->deleteCategorie($_POST["id"]);

    }

}
