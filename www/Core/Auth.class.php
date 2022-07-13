<?php

namespace App\Core;

interface AuthObserver 
{
    function update(Auth $auth, string $event);
}

class Auth
{
    private $observers = [];
    private int $userId;

    function loginEvent() {
        /** login logic */
        $this->notify('user:login');
    }

    function loginAttemptEvent(int $userId) {
        /** login logic */
        $this->userId = $userId;
        $this->notify('user:loginAttempt');
    }

    function logoutEvent() {
        /** logout logic */
        $this->notify('user:logout');
    }

    function getUserId()
    {
        return $this->userId;
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