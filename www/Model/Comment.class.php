<?php

namespace App\Model;

use App\Core\Cleaner;
use App\Core\Sql;
use App\Core\MysqlBuilder;

class Comment extends Sql
{
    protected $id;
    protected $content;
    protected $status;
    protected $id_parent;
    protected $id_user;
    protected $id_restaurant;
    protected $created_at;
    protected $updated_at;

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
     * @return null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int | null
     */
    public function getIdParent()
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

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }


    public function save(): void
    {
        parent::save();
    }

    public function getChildrenComment(int $parent_id)
    {
        $request = new MysqlBuilder();
        $result = $request->select("comments", ["*"])
                ->where("id_parent", $parent_id)
                ->fetchClass("comment")
                ->fetchAll();
        return $result;
    }


    
    public function getAddComment(int $id_restaurant): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/addComment",
                "class" => "flex flex-column",
                "id" => "",
                "submit" => "Publier",
                'captcha' => false
            ],
            "inputs" => [
                "content" => [
                    "type" => "textarea",
                    "label" => "Commentaire :",
                    "id" => "content",
                    "required" => true,
                    "minlength" => 20,
                    "maxlength" => 400
                ],
                "id_restaurant" => [
                    "type" => "hidden",
                    "id" => "id_restaurant",
                    "value" => $id_restaurant
                ]
            ]
        ];
    }

    public function replyComment($comment): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/replyComment",
                "class" => "flex flex-column",
                "id" => "",
                "submit" => "Répondre",
                'captcha' => false
            ],
            "inputs" => [
                "content" => [
                    "type" => "textarea",
                    "label" => "Commentaire :",
                    "id" => "content",
                    "required" => true,
                    "minlength" => 20,
                    "maxlength" => 400
                ],
                "id_restaurant" => [
                    "type" => "hidden",
                    "id" => "id_restaurant",
                    "value" => $comment->getIdRestaurant()
                ]
            ]
        ];
    }
   
    public function validateComment(int $id): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/validateComment",
                "class" => "flex flex-column",
                "id" => "",
                "submit" => "Valider",
                'captcha' => false
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "value" => $id
                ],
                "status" => [
                    "type" => "hidden",
                    "id" => "status",
                    "value" => 1
                ]
            ]
        ];
    }

    public function deleteComment(int $id): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/restaurant/deleteComment",
                "class" => "flex flex-column",
                "id" => "",
                "submit" => "Supprimer",
                'captcha' => false
            ],
            "inputs" => [
                "id" => [
                    "type" => "hidden",
                    "id" => "id",
                    "value" => $id
                ]
            ]
        ];
    }
}
