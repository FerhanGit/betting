<?php
namespace Betting\Models;

use Betting\Models\ViewModel;
use Betting\Interfaces\User;

class UserModel implements User
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
     * Checks if user has a valid identity and returns it. Otherwise display an error message.
     * @return arrat - USER entity || html layout with apropriate error message
     */
    public function loadUser()
    {
        $userInfo = []; // get it from any storage - Cach, Session or DB

        // Returns USER entity with all available data for this user.
        return $userInfo;
    }

}
