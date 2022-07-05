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
        session_start();
        $_POST["id_restaurant"] = intval($_POST["id_restaurant"]);
        $_POST["id_user"] = intval($_SESSION["user"]["id"]);
        $request = new MysqlBuilder();
        $result = $request->insert("comments", $_POST)
                ->fetchClass("comment")
                ->execute();
        header("Location: /"); 
    }
}
