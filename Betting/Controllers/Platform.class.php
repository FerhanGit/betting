<?php
namespace Betting\Controllers;

use Betting\Models\PlatformModel;
use Betting\Models\UserModel;
use Betting\Models\GameModel;


/**
 * All HTTP requests are performed using Basic HTTP authorization
 * All available methods are triggered asynchronously by Ajax calls according to user's actions
 * Guzzle HTTP client is used for http communication between the Platform and Operator\s
 * Any successful response is send back to javascript and relevant messsage is shown to the user
 * Any error in response is send back to javascript and relevant message is shown to the user
 *
 */
class Platform
{

    /**
     * Process betting - asynchronous action
     * @param array $params - could be passed some additional params
     * @return array - Params that will be passed to the layout and view files if any
     */
    public function bet($params = array())
    {
        try {
            // Gets user identity if user is logged in. If not - displays an error message.
            $userInfo = UserModel::getInstance()->loadUser();

            // IF user info is not available - we display an error message and terminate the stake operation;
            if (false === $userInfo) {
                // load php template with error message
                print json_encode(['error' => 'SOME ERROR MESSAGE']);
                exit;
            }

            // IF user is a valid one, we use his identity and send HTTP request to the Operator, which he is related to, to stake money from his account.
            $result = PlatformModel::getInstance()->stake($userInfo);

            if ('success' !== $result) {
                print json_encode(['error' => 'SOME ERROR MESSAGE']);
                exit;
            }

            // Taking decision to Win or Lose
            $decideToWinOrLose = PlatformModel::getInstance()->randomWinOrLose($userInfo);

            // Perfom HTTP request to Operator to ask it to handle the betting round
            $result = PlatformModel::getInstance()->winLose(array_merge($userInfo, ['winOrLose' => $decideToWinOrLose]));

             if ('success' !== $result) {
                print json_encode(['error' => 'SOME ERROR MESSAGE']);
                exit;
            }
        } catch (\Exception $ex) {
            print json_encode(['error' => 'SOME ERROR MESSAGE']);
            exit;
        }
        return json_encode($result);
        exit;
    }



    /**
     * Win/Lose action - decide to win or to lose and based on this asks Operator to perform monetary action.
     * Available only for authenticated users
     *
     * @param array $params
     * @return array - Params that will be passed to the layout and view files if any
     */
    public function showGame($params = array())
    {
        $result = GameModel::getInstance()->loadGame();
        return array_merge(
            $result,
            $params,
            ['loadViews' => ['showGame', 'menu']]);
    }


}
