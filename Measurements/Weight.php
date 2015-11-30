<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Weight extends Measurements
{

    const KILOGRAM = "KILOGRAM";
    const GRAM = "GRAM";
    const POUND = "POUND";

    protected $from = "KILOGRAM";
//    $format

    //Base is KILOGRAM
    protected $definitions = array(
        self::KILOGRAM => 1,
        self::GRAM => 0.001,
        self::POUND => 0.453592,
    );

    public function __construct($value)
    {
        $this->value = $value;
        parent::__construct();
    }


    public function getFactor()
    {
        if (is_null($this->to)) {
            if ( $this->unitSystem == Measurements::METRIC ){
                $this->to = self::KILOGRAM;
            }else{
                $this->to = self::POUND;
            }
        }

        return $this->definitions[$this->from]/$this->definitions[$this->to];
    }
} 