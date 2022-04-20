<?php

namespace App\Core;

class Cleaner
{
    public $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function lower()
    {
        $this->value = strtolower($this->value);
        return $this;
    }

    public function upper()
    {
        $this->value = strtoupper($this->value);
        return $this;
    }

    public function ucf()
    {
        $this->value = ucfirst($this->value);
        return $this;
    }

    public function ucw()
    {
        $this->value = ucwords($this->value);
        return $this;
    }

    public function e()
    {
        $this->value = trim($this->value);
        return $this;
    }
}
