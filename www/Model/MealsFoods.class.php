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
    public function getMealId(): int
    {
        return $this->meal_id;
    }

    /**
     * @param mixed $getFoodId
     */
    public function setMealId(int $meal_id): void
    {
        $this->meal_id = $meal_id;
    }

    /**
     * @return mixed
     */
    public function getFoodId(): int
    {
        return $this->getFoodId;
    }

    /**
     * @param mixed $getFoodId
     */
    public function setFoodId(int $getFoodId): void
    {
        $this->getFoodId = $getFoodId;
    }
    
}
