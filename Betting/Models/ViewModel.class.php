<?php
namespace Betting\Models;

class ViewModel
{
    static $_instance = null;

    const LAYOUT_DIR = "Betting\Views";
    const VIEWS_DIR = "Betting\Views";

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __construct()
    {
    }


    /**
     * Loads view file
     * @param type $viewName
     * @param type $viewParams
     * @return type
     */
    public static function LoadView($viewName, $viewParams = array())
    {
        $dir = self::VIEWS_DIR;

        if (file_exists($dir . DIRECTORY_SEPARATOR . strtolower($viewName) . '.php')) {
            require_once($dir . DIRECTORY_SEPARATOR . strtolower($viewName) . '.php');
            return;
        }
    }


    /**
     * Loads layout file
     * @param type $layoutName
     * @param type $layoutParams
     * @return type
     */
    public static function LoadLayout($layoutName, $layoutParams = array())
    {

        $dir = self::LAYOUT_DIR;

        if (file_exists($dir . DIRECTORY_SEPARATOR . strtolower($layoutName) . '.php')) {
            require_once($dir . DIRECTORY_SEPARATOR . strtolower($layoutName) . '.php');
            return;
        }
    }

}
