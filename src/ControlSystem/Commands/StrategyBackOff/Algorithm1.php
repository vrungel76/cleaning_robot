<?php

namespace app\ControlSystem\Commands\StrategyBackOff;

use app\ControlSystem;
use app\ControlSystem\Commands\Right;

/**
 * Class Algorithm1
 * TR, A
 * @package app\ControlSystem\Commands\StrategyBackOff
 */
class Algorithm1 extends BaseAlgorithm implements Strategy
{

    public function doAlgorithm(ControlSystem $control)
    {
        (new Right($control))->execute();
        $this->tryForward($control);

    }

}