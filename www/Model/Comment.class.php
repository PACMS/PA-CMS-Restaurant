<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;

class Comment extends Sql
{
    protected $id;
    protected $content;
    protected $id_parent;
    protected $id_user;
    protected $id_restaurant;

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
     * @return null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getIdParent(): int
    {
        return $this->id_parent;
    }

    /**
     * @param int $id_parent
     */
    public function setIdParent(int $id_parent): void
    {
        $this->id_parent = $id_parent;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return int
     */
    public function getIdRestaurant(): int
    {
        return $this->id_restaurant;
    }

    /**
     * @param int $id_restaurant
     */
    public function setIdRestaurant(int $id_restaurant): void
    {
        $this->id_restaurant = $id_restaurant;
    }

    public function save(): void
    {
        parent::save();
    }


    
    public function getAddComment(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/addComment",
                "class" => "flex",
                "id" => "",
                "submit" => "Publier",
                'captcha' => false
            ],
            "inputs" => [
                "name" => [
                    "type" => "textarea",
                    "label" => "Commentaire :",
                    "required" => true
                ]
            ]
        ];
    }
   
}
