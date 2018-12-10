<?php

namespace app\ControlSystem\Commands\StrategyBackOff;

use app\ControlSystem;
use app\ControlSystem\Commands\Back;
use app\ControlSystem\Commands\Forward;
use app\ControlSystem\Commands\Right;


/**
 * Class Algorithm4
 * TR, B, TR, A
 * @package app\ControlSystem\Commands\StrategyBackOff
 */
class Algorithm4  extends BaseAlgorithm implements Strategy
{

    public function doAlgorithm(ControlSystem $control)
    {
        (new Right($control))->execute();
        $this->tryBack($control);
        (new Right($control))->execute();
        $this->tryForward($control);
    }
}