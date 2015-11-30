<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Distance extends Measurements
{

    const METER = "METER";
    const FOOT = "FOOT";
    const KILOMETER = "KILOMETER";
    const MILE = "MILE";
    const CENTIMETER = "CENTIMETER";
    const INCH = "INCH";

    protected $from = "METER";

    protected $meterLimit = 0;

    protected static $footToInch;

//    $format

    //Base is METER
    protected $definitions = array(
        self::KILOMETER => 1000,
        self::METER => 1,
        self::CENTIMETER => 0.01,
        self::MILE => 1609.34,
        self::FOOT => 0.3048,
        self::INCH => 0.0254,
    );

    public function __construct($value = "")
    {
        self::$footToInch = $this->definitions[self::FOOT] / $this->definitions[self::INCH];
        $this->value = $value;
        parent::__construct();
    }

    public function setMeterLimit($value)
    {
        $this->meterLimit = $value;
        return $this;
    }


    public function getFactor()
    {

        if (is_null($this->to)) {

            if ($this->unitSystem == Measurements::METRIC) {
                $this->to = self::METER;
                if ($this->value >= $this->meterLimit) {
                    $this->to = self::KILOMETER;
                }
            } else {
                if ($this->from == Distance::CENTIMETER) {
                    $this->to = self::INCH;
                } else {
                    $this->to = self::MILE;
                }
            }
        }

        return $this->definitions[$this->from] / $this->definitions[$this->to];
    }


    public function getFeet()
    {
        return floor((string)$this / self::$footToInch);
    }


    public function getInches()
    {
        return fmod((string)$this, self::$footToInch);
    }

    public function convertToInches($inches, $feet = 0)
    {
        return $inches + self::$footToInch * $feet;
    }


    //Get Imperial
} 