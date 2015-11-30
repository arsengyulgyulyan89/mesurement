<?php
/**
 * Created by PhpStorm.
 * User: grigor
 * Date: 11/6/14
 * Time: 6:58 PM
 */

class Respiration extends Measurements
{

    protected $from = "BRPM";
    protected $to = "BRPM";

    const BRPM = 'BRPM';

    protected $definitions = array(
        self::BRPM => 1,
    );

    public function __construct($value)
    {
        $this->value = $value;
        parent::__construct();
    }
} 