<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Pressure extends Measurements
{

    protected $from = "MMHG";
    protected $to = "MMHG";

    const MMHG = 'MMHG';
    const PASCAL = 'PASCAL';

    protected $separator = " / ";

    protected $definitions = array(
        self::MMHG => 1,
        self::PASCAL => 133.322,
    );

    public function __construct($value)
    {

        $this->value = $value;
        parent::__construct();
    }


    public function getFactor()
    {
        if (is_null($this->to)) {
            if ($this->unitSystem == Measurements::METRIC) {
                $this->to = self::MMHG;
            } else {
                $this->to = self::MMHG;
            }
        }

        return $this->definitions[$this->from] / $this->definitions[$this->to];
    }

} 