<?php

namespace App\Core;

class View
{
    private $_view;
    private $_partial;
    private $_template;
    private $_data = [];

    public function __construct($view, $template = "front")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function setView($view): void
    {
        $this->_view = $view;
    }
    public function setTemplate($template): void
    {
        $this->_template = $template;
    }

    public function assign($key, $value): void
    {
        $this->_data[$key] = $value;
    }

    public function includePartial($partial, ?array $config = null): void
    {
        if (!file_exists("View/Partial/" . $partial . ".partial.php")) {
            die("le partial " . $partial . " n'existe pas");
        }

        include "View/Partial/" . $partial . ".partial.php";
    }

    public function __toString(): string
    {
        return "La vue c'est : " . $this->_view . " et le template c'est : " . $this->_template;
    }

    public function __destruct()
    {
        extract($this->_data);
        include "View/" . $this->_template . ".tpl.php";
    }
}
