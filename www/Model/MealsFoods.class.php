<?php

namespace App\Model;

use App\Core\Sql;

class MealsFoods extends Sql
{
    protected $id = null;
    protected $meal_id;
    protected $food_id;
    

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMealId(): string
    {
        return $this->meal_id;
    }

    /**
     * @param mixed $getFoodId
     */
    public function setMealId(string $meal_id): void
    {
        $this->meal_id = $meal_id;
    }

    /**
     * @return mixed
     */
    public function getFoodId(): string
    {
        return $this->food_id;
    }

    /**
     * @param mixed $food_id
     */
    public function setFoodId(string $food_id): void
    {
        $this->food_id = $food_id;
    }
    
}
