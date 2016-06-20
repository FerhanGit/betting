<?php
namespace Betting\Models;


use Betting\Models\GameModel;
use Betting\Interfaces\Platform;
use Betting\Models\ViewModel;
use Betting\Models\HttpClientModel as HttpClientModel;


/**
 * All HTTP requests are performed using Basic HTTP authorization
 * All available methods are triggered asynchronously by Ajax calls according to user's actions
 * Guzzle HTTP client is used for http communication between the Platform and Operator\s
 * Any successful response is send back to javascript and relevant messsage is shown to the user
 * Any error in response is send back to javascript and relevant message is shown to the user
 *
 */
class PlatformModel implements Platform
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
     * Sends 'Stake' request to the Operator
     * @param array $params - input params, including user's identity
     * @return boolean - true if operator response with success, false - if not.
     */
    public function stake($params = array())
    {
        $response = HttpClientModel::getInstance()->sendHttpRequest($params); // HTTP request sent here.

        // success/error/retry
        if (!$response || 'error' === $response || 'retry' === $response) {
            return $this->reconcile(array_merge($params, array('currentAction' => 'stake')));
        }

        // Here we can format the response and return only what is required
        return $response;
    }



    /**
     * Action decides to Win or to Lose and then send the win or lose request to Operator.
     * Available only for authenticated users
     *
     * @param array $params - input params, including user's identity
     * @return array - Params that will be passed to the layout and view files if any
     */
    public function winLose($params = array())
    {
        $winOrLose = $params['winOrLose']; // win, lose

        $response = HttpClientModel::getInstance()->sendHttpRequest($params); // HTTP request sent here.

        // success/error/retry
        if (!$response || 'error' === $response || 'retry' === $response) {
            return $this->reconcile(array_merge($params, array('currentAction' => $winOrLose)));
        }

        // Here we can format the response and return only what is required
        return $response;

    }



    /**
     * Reconcile action - repeat the last failed operation until getting success or exceeding retry limit (10)
     * @param type $params - input params, including user's identity
     * @return boolean
     */
    public function reconcile($params = array())
    {
        $currentAction = $params['currentAction']; // stake, win, lose

        // HTTP request sent here. Use $currentAction to retry the request until succeeded.
        $response = HttpClientModel::getInstance()->sendHttpRequest($params);

        if ('success' === $response) {
            print json_encode($response);
            exit;
        }

        $loopNum = !empty($params['loopNum']) ? $params['loopNum'] : 1;
        // error/retry
        if (!$response || 'error' === $response || 'retry' === $response) {
            if ($loopNum == 10) {
                // If still not succeeded after all attempts - add user for manual cancellation/refund
                print json_encode(['error' => 'SOME ERROR MESSAGE']);
                exit;
            }

            $loopNum++;

            // try again after some time
            sleep(pow(2, $loopNum) * 30);

            // RETRY until we get success or terminate for manual cancellation/refund
            $this->reconcile(array_merge($params, array('loopNum' => $loopNum, 'currentAction' => $currentAction)));
        }
    }


    /**
     * Use some algorithm to decide if the current user should win or lose, so it is not that random :)
     * @param type $params - input params, including user's identity
     * @return boolean
     */
    private function randomWinOrLose($params = array())
    {
        // do the logic here
    }
}
