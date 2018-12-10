<?php

namespace app\ControlSystem\Commands\StrategyBackOff;


use app\ControlSystem;
use app\ControlSystem\Commands\Back;
use app\ControlSystem\Commands\Forward;
use app\ControlSystem\Commands\Left;
use app\ControlSystem\Commands\Right;

/**
 * Class Algorithm2
 * TL, B, TR, A
 * @package app\ControlSystem\Commands\StrategyBackOff
 */
class Algorithm2  extends BaseAlgorithm implements Strategy
{
    public function doAlgorithm(ControlSystem $control)
    {
        (new Left($control))->execute();
        $this->tryBack($control);
        (new Right($control))->execute();
        $this->tryForward($control);

    }
}