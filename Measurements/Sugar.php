<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Sugar extends Measurements
{

    protected $from = "MILIMOL_L";

    const MILIGRAM_DL = 'MILIGRAM_DL';
    const MILIMOL_L = 'MILIMOL_L';

    protected $definitions = array(
        self::MILIGRAM_DL => 1,
        self::MILIMOL_L => 18,
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
                $this->to = self::MILIMOL_L;
            } else {
                $this->to = self::MILIGRAM_DL;
            }
        }

        return $this->definitions[$this->from] / $this->definitions[$this->to];
    }
} 