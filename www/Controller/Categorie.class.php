<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\View;
use App\Model\Categorie as CategorieModel;

class Categorie
{

    public function createcategorie()
    {
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

}
