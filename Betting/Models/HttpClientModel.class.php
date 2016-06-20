<?php

namespace Betting\Models;

use Betting\Interfaces\Operator;
use \GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;


/**
 * This class can be used for additional interacion between the Platform and Operators
 * - for example to get all operator's users, supported games , etc..
 *
 */
class HttpClientModel
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


    public function sendHttpRequest($params = array())
    {
        // Simulate retry operation
        return 'retry';

        try {
            $method = !empty($params['requestMethod']) ?  $params['requestMethod'] : 'GET';
            $url = !empty($params['requestURL']) ?  $params['requestURL'] : 'https://www.google.bg';
            $requestOptions = !empty($params['requestOptions']) ?  $params['requestOptions'] : ['auth' => ['username', 'password']];

            $client = new HttpClient();
            $promise = $client->requestAsync($method, $url, $requestOptions);
            $promise->then(
                function (ResponseInterface $res) {
                    return [
                        'httpCode' => $res->getStatusCode(),
                        'result' => $res->getBody(),
                    ];
                },
                function (RequestException $e) {
                    return [
                        'method' => $e->getRequest()->getMethod(),
                        'httpCode' => $e->getErrorCode(),
                        'error' => $e->getMessage(),
                    ];
                }
            );
        } catch (\Exception $ex) {
            return 'error';
        }
    }


    public function __destruct()
    {

    }
}
