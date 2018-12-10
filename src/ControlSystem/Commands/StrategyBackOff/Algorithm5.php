<?php

namespace app\ControlSystem\Commands\StrategyBackOff;

use app\ControlSystem;
use app\ControlSystem\Commands\Forward;
use app\ControlSystem\Commands\Left;


/**
 * Class Algorithm5
 * TL, TL, A
 * @package app\ControlSystem\Commands\StrategyBackOff
 */
class Algorithm5  extends BaseAlgorithm implements Strategy
{

    public function doAlgorithm(ControlSystem $control)
    {
        (new Left($control))->execute();
        (new Left($control))->execute();
        $this->tryForward($control);
    }
}