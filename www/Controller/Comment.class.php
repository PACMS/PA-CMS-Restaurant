<?php

namespace App\Controller;

use App\Controller\Mail;
use App\Core\View;
use App\Model\Comment as CommentModel;
use App\Core\MysqlBuilder;

class Comment
{

    public function mailAskForComment(string $email, string $name, int $id_restaurant)
    {
        $mail = new Mail();
        $mail->askCommentMail($email, $name, $id_restaurant);
    }

    public function addCommentView()
    {
        $_SESSION['previous_location'] = 'addComment';
        $comment = new CommentModel();
        $view = new View("comment", "front");
        $view->assign('comment', $comment);
        $view->assign('id_restaurant', $_GET["restaurant"]);
    }

    public function stockComment()
    {
        @session_start();
        $mail = new Mail();
        $_POST = array_map('htmlspecialchars', $_POST);
        $_POST["id_restaurant"] = intval($_POST["id_restaurant"]);
        $_POST["id_user"] = intval($_SESSION["user"]["id"]);
        $request = new MysqlBuilder();
        $result = $request->insert("comments", $_POST)
                ->fetchClass("comment")
                ->execute();
        $users = $request->select("user", ["*"])
                ->where("role", "admin")
                ->fetchClass("user")
                ->fetchAll();
        foreach ($users as $value) {
            $mail->askValidationComment($value);
        }
        header("Location: /"); 
    }

    public function getComments()
    {
        $request = new MysqlBuilder();
        $comment = new CommentModel();
        $view = new View("comments", "back");
        $result = $request->select("comments", ["*"])
                ->where("id_restaurant", $_SESSION["restaurant"]["id"])
                ->fetchClass("comment")
                ->fetchAll();
        $view->assign('comments', $result);
        $view->assign('comment', $comment);
    }

    public function validateComment()
    {
        $request = new MysqlBuilder();
        $_POST = array_map('htmlspecialchars', $_POST);
        $request
            ->update("comments", ["status" => 1])
            ->where("id", $_POST["id"])
            ->fetchClass("comment")
            ->execute();
        header("Location: /restaurant/comments");
    }

    public function deleteComment()
    {
        $request = new MysqlBuilder();
        $_POST = array_map('htmlspecialchars', $_POST);
        $request
            ->delete("comments", ["id" => $_POST["id"]])
            ->fetchClass("comment")
            ->fetch();
        header("Location: /restaurant/comments");
    }

    public function showComments()
    {
        $request = new MysqlBuilder();
        $result = $request->select("comments", ["*"])
                ->where("id_restaurant", 74)
                ->fetchClass("comment")
                ->fetchAll();
        $view = new View("comments-front", "front");
        $view->assign('comments', $result);
    }
}
