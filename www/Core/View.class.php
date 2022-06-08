<?php

/**
 * PHP version 8.1
 */
namespace App\Core;

/**
 * Class View
 * 
 * @category Core
 * 
 * @package App\Core
 */
class View
{
    private $_view;
    private $_partial;
    private $_template;
    private $_alert;
    private $_alert_title;
    private $_alert_message;
    private $_data = [];


    /**
     * Constructor
     * 
     * @param string      $view          Name of the view
     * @param null|string $template      Name of the template (front or back) (default: front)
     * @param null|string $alert         Type of alert (default: null) (success, error, warning, info)
     * @param null|string $alert_title   Title of the alert (default: null)
     * @param null|string $alert_message Message of the alert (default: null)
     * 
     * @return void
     */
    public function __construct(string $view, ?string $template = "front", ?string $alert = null, ?string $alert_title = null, ?string $alert_message = null)
    {
        $this->setView($view);
        $this->setTemplate($template);
        $this->setAlert($alert, $alert_title, $alert_message);
    }

    /**
     * Set the view
     * 
     * @param string $view Name of the view
     * 
     * @return void
     */
    public function setView(string $view): void
    {
        $this->_view = $view;
    }

    /**
     * Set the template
     * 
     * @param string $template Name of the template (front or back)
     * 
     * @return void
     */
    public function setTemplate(string $template): void
    {
        $this->_template = $template;
    }

    /**
     * Set the alert
     * 
     * @param string      $alert         Type of alert (success, error, warning, info)
     * @param null|string $alert_title   Title of the alert
     * @param null|string $alert_message Message of the alert
     * 
     * @return void
     */
    public function setAlert(string $alert, string $alert_title, string $alert_message): void
    {
        $this->_alert = $alert;
        $this->_alert_title = $alert_title;
        $this->_alert_message = $alert_message;
    }

    /**
     * Assign data to the view
     * 
     * @param string $key   Name of the data
     * @param mixed  $value Data to assign
     * 
     * @return void
     */
    public function assign(string $key, mixed $value): void
    {
        $this->_data[$key] = $value;
    }

    /**
     * Include the partial view
     * 
     * @param string     $partial The name of the partial view
     * @param null|array $config  The config of the partial view (default: null)
     * 
     * @example "" Pour la topBar $this->includePartial("topBar", ["title" => "My title"]);
     * 
     * @return void include the partial view
     */
    public function includePartial(string $partial, ?array $config = null): void
    {
        if (!file_exists("View/Partial/" . $partial . ".partial.php")) {
            die("le partial " . $partial . " n'existe pas");
        }

        include "View/Partial/" . $partial . ".partial.php";
    }

    /**
     * Return the view and the template in a string
     * 
     * @dev
     * 
     * @return string The view and the template in a string
     */
    public function __toString(): string
    {
        return "La vue c'est : " . $this->_view . " et le template c'est : " . $this->_template;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        extract($this->_data);
        include "View/" . $this->_template . ".tpl.php";
        if (!empty($this->_alert)) {
            include "View/alert.tpl.php";
        }
    }
}
