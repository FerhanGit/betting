<?php
namespace Betting\Models;

use Betting\Models\ViewModel;

class PlatformModel
{
    /**
     * Loads the layout file and passes some params to it
     * @param array $result
     * @param mixed
     */
    public static function run($result = null)
    {
        ViewModel::LoadLayout('layout', $result);
    }

    /**
     * Shoot action -
     * @param array $params
     * @return array - Params that will be passed to the layout and view files if any
     */
    public static function stake($params = array())
    {
        return ['test' => 1];

        
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
    }



    /**
     * Show action - shows ships positions.
     * Available only for authenticated users
     *
     * @param array $params
     * @return array - Params that will be passed to the layout and view files if any
     */
    public static function winLose($params = array())
    {
        return ['test' => 2];
    }



    public static function reconcile($params = array())
    {
        return ['test' => 3];
    }

}
