<?php

namespace App\Model;

use App\Core\Sql;

class Page extends Sql
{
    protected $id = null;
    protected $name;
    protected $url ;
    protected $status ;
    protected $id_theme ;
    protected $id_restaurant ;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getIdTheme()
    {
        return $this->id_theme;
    }

    /**
     * @param null $id_theme
     */
    public function setIdTheme($id_theme): void
    {
        $this->id_theme = $id_theme;
    }

    /**
     * @return null
     */
    public function getIdRestaurant()
    {
        return $this->id_restaurant;
    }

    /**
     * @param null $id_restaurant
     */
    public function setIdRestaurant($id_restaurant): void
    {
        $this->id_restaurant = $id_restaurant;
    }

}