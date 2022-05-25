<?php

namespace App\Core;

class Theme extends View
{
    protected $template;
    protected $data = [];

    public function __construct($view, $template = 1)
    {
        parent::__construct($view, $template);
    }

    public function setView($view): void
    {
        parent::setView($view);
    }

    public function setTemplate($template): void
    {
        $this->template = 'theme_' . $template;
    }

    public function assign($key, $value): void
    {
        parent::assign($key, $value);
    }

    public function __destruct()
    {
        extract($this->data);
        include "Template/".$this->template."/index.tpl.php";
    }
}