<?php
namespace Betting\Models;

use Betting\Models\ViewModel;
use Betting\Interfaces\Game;

class GameModel implements Game
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
     * Loads Game related data
     * @return array - Game entity
     */
    public function loadGame()
    {
        $gameInfo = []; // get it from DB

        // Returns Game entity with all available data for this game.
        return $gameInfo;
    }

}
