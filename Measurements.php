<?php

class Measurements
{
    protected $value; // Base value ( or array of values ) that should be converted
    protected $separator = " "; // Using only when $value is array
    protected $from; // Measurement unit converted from
    protected $to; // Measurement unit converted to
    protected $round = 2; // Round result after converting
    protected $showMeasureUnit = true; // show measurable unit or not


    const METRIC = "metric";
    const IMPERIAL = "imperial";

    //Number Formaters
    protected $dec_point = ".";
    protected $thousands_sep = ",";

    public static $UNITS = array();

    /**
     * Setting Measurment units labels
     *
     * @param none
     * @return none
     */
    public static function setUNITS()
    {

        self::$UNITS = array(
            'Speed' => array(
                Speed::MILES_PER_HOUR => Yii::t('main_translator', 'mph'),
                Speed::KILOMETER_PER_HOUR => Yii::t('main_translator', 'km_h'),
                Speed::METER_PER_SECOND => Yii::t('main_translator', 'm_s'),
            ),
            'Distance' => array(
                Distance::INCH => Yii::t('main_translator', 'in'),
                Distance::FOOT => Yii::t('main_translator', 'ft'),
                Distance::KILOMETER => Yii::t('main_translator', 'km'),
                Distance::MILE => Yii::t('main_translator', 'mi'),
                Distance::METER => Yii::t('main_translator', 'm'),
                Distance::CENTIMETER => Yii::t('main_translator', 'cm'),
            ),
            'Weight' => array(
                Weight::KILOGRAM => Yii::t('main_translator', 'kg'),
                Weight::GRAM => Yii::t('main_translator', 'g'),
                Weight::POUND => Yii::t('main_translator', 'lb'),
            ),
            'Sugar' => array(
                Sugar::MILIGRAM_DL => Yii::t('main_translator', 'mg_dL'),
                Sugar::MILIMOL_L => Yii::t('main_translator', 'mmol_L'),
            ),
            'Pressure' => array(
                Pressure::MMHG => Yii::t('main_translator', 'mmHg'),
                Pressure::PASCAL => Yii::t('main_translator', 'Pa'),
            ),
            'Heartrate' => array(
                Heartrate::BPM => Yii::t('main_translator', 'bpm'),
            ),
            'Respiration' => array(
                Respiration::BRPM => Yii::t('main_translator', 'brpm'),
            ),
            'CAL' => array(
                Calories::CAL => Yii::t('main_translator', 'cal'),
            )
        );
    }


    public static function getUNITS($section, $key)
    {
        if (count(self::$UNITS) == 0) {
            self::setUNITS();
        }

        if (isset(self::$UNITS[$section][$key])) {
            return self::$UNITS[$section][$key];
        }

        return "";
    }


    public function __construct()
    {
        self::setUNITS();
    }


    public function __get($name)
    {
        $method = "get" . ucfirst($name);
        return $this->$method();
    }


    public function __set($name, $value)
    {
        $method = "set" . ucfirst($name);
        return $this->$method($value);
    }

    /**
     *  Apply conversation and returning the result
     *
     * @param none
     * @return string
     */
    public function __toString()
    {
        $calledClass = get_called_class();

        if (is_array($this->value) && count($this->value) > 0) {
            $values = $this->value;
            foreach ($values as &$value) {
                $value = $value * $this->factor;
                $value = number_format($value, $this->round, $this->dec_point, $this->thousands_sep);
            }

            $return = implode($this->separator, $values);
        } else {
            if (is_numeric($this->value)) {
                $value = $this->value * $this->factor;


                $return = number_format($value, $this->round, $this->dec_point, $this->thousands_sep);
            } else {
                $return = $this->value;
            }
        }

        $measureUnit = "";
        if ($this->showMeasureUnit && isset(self::$UNITS[$calledClass][$this->to])) {
            $measureUnit .= ' <span>' . self::$UNITS[$calledClass][$this->to] . '</span>';
        }

        return $return . $measureUnit;
    }

    /**
     * Factory Constructor
     *
     * @param string $constructor
     * @param string / an array of string objects $value
     * @return object
     */
    public static function helper($constructor, $value = "")
    {
        if (class_exists($constructor)) {
            return new $constructor($value);
        }
    }

    /**
     *  removes measure unit on string converting
     *
     * @param none
     * @return $this
     */

    public function disableMeasureUnit()
    {
        $this->showMeasureUnit = false;
        return $this;
    }


    public function round($number = 2)
    {
        $this->round = $number;
        return $this;
    }

    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    public function to($to)
    {
        $this->to = $to;
        return $this;
    }


    public function getUnit()
    {
        $calledClass = get_called_class();

        return self::$UNITS[$calledClass][$this->to];
    }


    //GETTERS

    public function getFactor()
    {
        return 1;
    }

    public function getUnitSystem()
    {
        return Yii::app()->user->getState("unit_system");
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getFrom()
    {
        return $this->from;
    }


}