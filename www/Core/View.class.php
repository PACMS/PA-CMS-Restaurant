<?php

namespace App\Core;

class View
{
    private $_view;
    private $_partial;
    private $_template;
    private $_alert;
    private $_alert_title;
    private $_alert_message;
    private $_data = [];

    public function __construct($view, $template = "front", $alert= null, $alert_title = null, $alert_message = null)
    {
        $this->setView($view);
        $this->setTemplate($template);
        $this->setAlert($alert, $alert_title, $alert_message);
    }

    public function setView($view): void
    {
        $this->_view = $view;
    }
    public function setTemplate($template): void
    {
        $this->_template = $template;
    }
    public function setAlert($alert, $alert_title, $alert_message): void
    {

        $this->_alert = $alert;
        $this->_alert_title = $alert_title;
        $this->_alert_message = $alert_message;
    }

    public function assign($key, $value): void
    {
        $this->_data[$key] = $value;
    }

    /**
     * Include the partial view
     * 
     * @param string $partial The name of the partial view
     * @param ?array $config  The config of the partial view | null
     * 
     * @example "" Pour la topBar $this->includePartial("topBar", ["title" => "My title"]);
     * 
     * @return void include the partial view
     */
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
        if (!empty($this->_alert)){
            include "View/alert.tpl.php";
        }

    }
}
