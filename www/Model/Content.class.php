<?php

namespace App\Model;

use App\Core\Sql;

class Content extends Sql
{
    protected $id = null;
    protected $id_page ;
    protected $body ;

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
    public function getIdPage()
    {
        return $this->id_page;
    }

    /**
     * @param mixed $id_page
     */
    public function setIdPage($id_page): void
    {
        $this->id_page = $id_page;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    public function getAllContentsFromIdPage(int $id)
    {
        $content = parent::databaseFindAll("SELECT * FROM " . DBPREFIXE . "content" , ['id_page' => $id]);
        return $content;
    }

}