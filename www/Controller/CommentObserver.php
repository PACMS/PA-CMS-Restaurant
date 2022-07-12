<?php

namespace App\Controller;


class CommentObserver implements \SplObserver
{
    public function update(\SplSubject $subject): void
    {
        dd('ok');
        if ($subject->state < 3) {
            echo "ConcreteObserverA: Reacted to the event.\n";
        }
    }
}