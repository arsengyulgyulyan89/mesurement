<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Speed extends Measurements
{

    protected $from = "KILOMETER_PER_HOUR";

    const MILES_PER_HOUR = 'MILES_PER_HOUR';
    const KILOMETER_PER_HOUR = 'KILOMETER_PER_HOUR';
    const METER_PER_SECOND = 'METER_PER_SECOND';

    protected $definitions = array(
        self::MILES_PER_HOUR => 1.60934,
        self::KILOMETER_PER_HOUR => 1,
        self::METER_PER_SECOND => 3.6,
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
                $this->to = self::KILOMETER_PER_HOUR;
            } else {
                $this->to = self::MILES_PER_HOUR;
            }
        }

        return $this->definitions[$this->from] / $this->definitions[$this->to];
    }
} 