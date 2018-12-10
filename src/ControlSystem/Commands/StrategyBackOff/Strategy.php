<?php

namespace app\ControlSystem\Commands\StrategyBackOff;

use app\ControlSystem;

interface Strategy
{
    public function doAlgorithm(ControlSystem $control);
}