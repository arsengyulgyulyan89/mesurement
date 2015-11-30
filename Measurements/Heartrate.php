<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Heartrate extends Measurements
{

    protected $from = "BPM";
    protected $to = "BPM";

    const BPM = 'BPM';

    protected $definitions = array(
        self::BPM => 1,
    );

    public function __construct($value)
    {
        $this->value = $value;
        parent::__construct();
    }
} 