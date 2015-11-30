<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Calories extends Measurements
{

    protected $from = "CAL";
    protected $to = "CAL";

    const CAL = 'CAL';

    protected $definitions = array(
        self::CAL => 1,
    );

    public function __construct($value)
    {
        if ( $value == 0 ){
            $value = "-";
        }
        $this->value = $value;
        parent::__construct();
    }
} 