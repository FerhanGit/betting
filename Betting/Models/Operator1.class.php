<?php

namespace Betting\Models;

use Betting\Interfaces\Operator;
use \GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class Operator1Model implements Operator
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
        $result = self::getInstance()->_parseRequest($URI);

        $client = new HttpClient();
        $promise = $client->requestAsync('GET', 'https://www.google.bg');
        $promise->then(
            function (ResponseInterface $res) {echo __LINE__;
                echo $res->getStatusCode() . "\n";
                echo $res->getBody();exit;
            },
            function (RequestException $e) {
                echo $e->getMessage() . "\n";
                echo $e->getRequest()->getMethod();exit;
            }
        );


        return WebBoard::run($result);
    }


    /**
     * Converts any given request into Controller::method($params) call
     *
     * @param array $URI
     * @return array $result
     */
    private function _parseRequest($URI = null)
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
