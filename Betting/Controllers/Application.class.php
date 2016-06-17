<?php

namespace Betting\Controllers;

use Betting\Models\ViewModel;
use \GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class Application
{
    static $_instance = null;

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
     * Parse the request and serve the result output
     * @param array $URI
     * @return mixed
     */
    public static function run($URI = null)
    {
        // Any Pre-dispatch actions goes here

        $result = self::getInstance()->parseRequest($URI);
        
        // Any Post-dispatch actions goes here

        // Pass the result to the layout and display it
        return ViewModel::LoadLayout('layout', $result);;
    }


    /**
     * Converts any given request into Controller::method($params) call
     *
     * @param array $URI
     * @return array $result
     */
    private function parseRequest($URI = null)
    {
        $result = array();

        if ($URI[0] !== '' && $URI[1] !== '') {
            $className = __NAMESPACE__ . DIRECTORY_SEPARATOR . ucfirst($URI[0]);
            $methodName = $URI[1];
            $params = array_slice($URI, 1);
            $result = $className::$methodName($params);
        }

        return $result;
    }



    public function __destruct()
    {

    }
}
