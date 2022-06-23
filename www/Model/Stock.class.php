<?php

namespace App\Model;

use App\Core\Sql;
use App\Core\Cleaner;

/**
 *
 */
class Stock extends Sql
{
    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var
     */
    protected $restaurantId;
    

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function setId($id): void
    {
        $this->id = $id; 
    }

    // getter and setter for name	
    /**
     * @return mixed
     */
    public function getRestaurantId()
    {
        return $this->restaurantId;
    }

    /**
     * @param mixed $restaurantId
     */
    public function setRestaurantId(int $restaurantId): void
    {
        $this->restaurantId = $restaurantId;
    }


    


    public function getAllStocks(array $params)
    {
        $stocks = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "stock", $params);
        var_dump($stocks);
        return $stocks;
    }

    // public function databaseDeleteOneRestaurant(string $table, int $id)
    // {
    //     $restaurant = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . $table . " WHERE id = :id", ['id' => $id]);
    //     var_dump($restaurant);
    //     return $restaurant;
    // }

    public function getOneStock(string $table, array $params)
    {
        $stock = parent::databaseFindOne($params, $table);
        return $stock;
    }
}
