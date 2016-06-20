<?php

namespace Betting\Models;

use Betting\Interfaces\Operator;

/**
 * This class can be used for additional interacion between the Platform and Operators
 * - for example to get all operator's users, supported games , etc..
 *
 */
class OperatorModel implements Operator
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


    public function __destruct()
    {

    }
}
