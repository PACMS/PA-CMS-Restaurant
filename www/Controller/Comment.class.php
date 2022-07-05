<?php

namespace App\Controller;

use App\Controller\Mail;
use App\Core\View;
use App\Model\Comment as CommentModel;

class Comment
{

    public function mailAskForComment(string $email, string $name)
    {
        $mail = new Mail();
        $mail->askCommentMail($email, $name);
    }

    public function addCommentView()
    {
        $comment = new CommentModel();
        $view = new View("comment", "front");
        $view->assign('comment', $comment);
    }
}
