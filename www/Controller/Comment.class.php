<?php

namespace App\Controller;

use App\Controller\Mail;
use App\Core\View;
use App\Model\Comment as CommentModel;
use App\Core\MysqlBuilder;
use App\Controller\CommentObserver;

class Comment implements \SplSubject
{
    public $state;
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function mailAskForComment(string $email, string $name, int $id_restaurant)
    {
        $mail = new Mail();
        $mail->askCommentMail($email, $name, $id_restaurant);
    }

    public function addCommentView()
    {
        // $_SESSION['previous_location'] = 'addComment';
        unset($_SESSION['previous_location']);
        $comment = new CommentModel();
        $view = new View("comment", "front");
        $view->assign('comment', $comment);
        $view->assign('id_restaurant', $_GET["restaurant"]);

        
    }

    public function stockComment()
    {
        if (empty($_SESSION["user"])) {
            @session_start();
            $_SESSION['previous_location'] = str_replace($_SERVER["HTTP_ORIGIN"], "", $_SERVER["HTTP_REFERER"]);
            $_SESSION["tempoComment"] = $_POST["content"];
            header("Location: /login");
        }
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
        //    $mail->askValidationComment($value);
        }
        $toto = new CommentObserver();
        $this->attach($toto);
        $this->notify();
        unset($_SESSION['previous_location']);
        header("Location: " . str_replace($_SERVER["HTTP_ORIGIN"], "", $_SERVER["HTTP_REFERER"]));
    }

    public function getComments()
    {
        if(is_null($_SESSION["restaurant"]["id"])) {
            header("Location: /restaurants");
        }
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
        (new \App\Controller\Page)->refreshPages();
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
        (new \App\Controller\Page)->refreshPages();
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

    public function replyComment() 
    {
        if (empty($_SESSION["user"])) {
            @session_start();
            $_SESSION['previous_location'] = str_replace($_SERVER["HTTP_ORIGIN"], "", $_SERVER["HTTP_REFERER"]);
            $_SESSION["tempoComment"] = $_POST["content"];
            header("Location: /login");
        }
        $mail = new Mail();
        $_POST = array_map('htmlspecialchars', $_POST);
        $_POST["id_user"] = intval($_SESSION["user"]["id"]);
        $request = new MysqlBuilder();
        $result = $request->insert("comments", $_POST)
                ->fetchClass("comment")
                ->execute();
        $users = $request->select("user", ["*"])
                ->where("role", "admin")
                ->fetchClass("user")
                ->fetchAll();
        try {
            foreach ($users as $value) {
                $mail->askValidationComment($value);
            }
        } catch (\Exception $e) {
            header("Location: " . str_replace($_SERVER["HTTP_ORIGIN"], "", $_SERVER["HTTP_REFERER"]));
        }
        unset($_SESSION['previous_location']);
        //Une notif pour dire que son commentaire est en cours de traiement
        header("Location: " . str_replace($_SERVER["HTTP_ORIGIN"], "", $_SERVER["HTTP_REFERER"]));
    }

    public function attach(\SplObserver $observer): void
    {
        dd('ok');
        echo "Subject: Attached an observer.\n";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer): void
    {
        $this->observers->detach($observer);
        echo "Subject: Detached an observer.\n";
    }

    /**
     * Trigger an update in each subscriber.
     */
    public function notify(): void
    {

        echo "Subject: Notifying observers...\n";
        dd($this->observers);
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
