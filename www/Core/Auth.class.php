<?php

namespace App\Core;

interface AuthObserver 
{
    function update(Auth $auth, string $event);
}

class Auth
{
    private $observers = [];

    function loginEvent() {
        /** login logic */
        $this->notify('user:login');
    }

    function logoutEvent() {
        /** logout logic */
        $this->notify('user:logout');
    }

    function attach(AuthObserver $observer) {
        $this->observers[spl_object_hash($observer)] = $observer;
    }

    function detach(AuthObserver $observer) {
        unset($this->observers[spl_object_hash($observer)]);
    }

    function notify(string $event) {
        foreach ($this->observers as $observer) {
            $observer->update($this, $event);
        }
    }

}