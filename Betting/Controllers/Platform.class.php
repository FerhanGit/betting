<?php
namespace Betting\Controllers;

use Betting\Models\PlatformModel;


class Platform
{

    /**
     * Shoot action -
     * @param array $params
     * @return array - Params that will be passed to the layout and view files if any
     */
    public static function stake($params = array())
    {
        $result = PlatformModel::stake();
        return array_merge(
            $result,
            $params,
            array('loadViews' => array('stake', 'menu')));
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
        $result = PlatformModel::stake();
        return array_merge(
            $result,
            $params,
            array('loadViews' => array('winLose', 'menu')));
    }



    public static function reconcile($params = array())
    {
        $result = PlatformModel::stake();
        return array_merge(
            $result,
            $params,
            array('loadViews' => array('reconcile', 'menu')));
    }

}
