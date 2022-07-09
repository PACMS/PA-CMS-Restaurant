<?php

namespace App\Controller;

use App\Core\Verificator;
use App\Core\MysqlBuilder;

class MealsFoods
{
    public function deleteFoods()
    {
        $builder = new MysqlBuilder();
        $meals = $builder->select("meal", ["*"])
                        ->where("id_carte", $_SESSION["id_card"])
                        ->fetchClass("meal")
                        ->fetchAll();
        $mealsFoods = $builder->select("mealsFoods", ["*"])
                            ->where("meal_id", $_POST["id_meal"])
                            ->fetchClass("mealsFoods")
                            ->fetchAll();
        foreach ($meals as $meal) {
            foreach ($mealsFoods as $food) {
                if ($meal->getId() == $food->getMealId()) {
                    $builder->delete("mealsFoods", ["id" => $_POST["id"]])
                            ->fetchClass("mealsFoods")
                            ->execute();
                }
            }
        }
        header("Location: /restaurant/carte/meals");
    }
}
