<?php

namespace App\Model;

use App\Core\Sql;

class Page extends Sql
{
    protected $id = null;
    protected $title;
    protected $url ;
    protected $status ;
    protected $display_menu;
    protected $display_comments;
    protected $display_reservations;
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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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

    /**
     * @return null
     */
    public function getDisplayMenu()
    {
        return $this->display_menu;
    }

    /**
     * @param null $display_menu
     * 
     */
    public function setDisplayMenu($display_menu): void
    {
        $this->display_menu = $display_menu;
    }

    /**
     * @return null
     */
    public function getDisplayComments()
    {
        return $this->display_comments;
    }

    /**
     * @param null $display_comments
     */
    public function setDisplayComments($display_comments): void
    {
        $this->display_comments = $display_comments;
    }

    /**
     * @param null $display_reservations
     */
    public function setDisplayReservations($display_reservations): void
    {
        $this->display_reservations = $display_reservations;
    }

    /**
     * @return null
     */
    public function getDisplayReservations()
    {
        return $this->display_reservations;
    }

    /**
     * Retrieve all pages
     *
     * @return void
     */
    public function getAllPages()
    {
        return parent::getAll();
    }

    public function getAllPagesFromRestaurant(?int $id = null)
    {
        $pages = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "page" , ['id_restaurant' => $id]);
        return $pages;
    }

    public function getPageFromRestaurant(?int $id)
    {
        $page = parent::findOneBy(['id_restaurant' => $id, 'title' => 'index']);
        if (!$page) {
            $page = parent::findOneBy(['id_restaurant' => $id]);
        }
        return $page;
    }

    public function getPageId(string $table, int $id)
    {
        $page = parent::databaseFindOne(['id' => $id], $table);
        return $page;
    }

    public function databaseDeleteOnePage(array $params)
    {
        $page = parent::databaseDeleteOne("DELETE FROM " . DBPREFIXE . "page" . " WHERE id = :id", $params);
        return $page;
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            unlink($dir . DIRECTORY_SEPARATOR . $item);
                   
              
    
        }
    
        return rmdir($dir);
    }
}