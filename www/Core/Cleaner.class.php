<?php

namespace App\Core;

/**
 * Class Cleaner
 *
 * @category Class
 *
 * @package App\Core
 *
 * @access public
 *
 * @author PACMS <pa.cms.test@gmail.com>
 *
 */
class Cleaner
{
    public $value;

    /**
     * Cleaner constructor.
     *
     * @param string $value The value to clean
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Put the value in lowercase
     *
     * @return string The value in lowercase
     */
    public function lower()
    {
        $this->value = strtolower($this->value);
        return $this;
    }

    /**
     * Put the value in uppercase
     *
     * @return string The value in uppercase
     */
    public function upper()
    {
        $this->value = strtoupper($this->value);
        return $this;
    }

    /**
     * Put the first character of the value in uppercase
     *
     * @return string The value with the first character in uppercase
     */
    public function ucf()
    {
        $this->value = ucfirst($this->value);
        return $this;
    }

    /**
     * Put the first character of each word in the value in uppercase
     *
     * @return string The value with the first character of each word in uppercase
     */
    public function ucw()
    {
        $this->value = ucwords($this->value);
        return $this;
    }

    /**
     * Remove all spaces from the value
     *
     * @return string The value without spaces
     */
    public function e()
    {
        $this->value = trim($this->value);
        return $this;
    }
}
