<?php

namespace app\ControlSystem\Commands;

use app\ControlSystem;

abstract class Command implements CommandInterface
{
    protected $powerUnit = 0;
    protected $turn = 0;
    protected $control;

    public function __construct(ControlSystem $control)
    {
        $this->control = $control;
    }

    public function execute()
    {
        $state = $this->control->getState();
        $state->battery->consumePowerUnit($this->powerUnit);
    }
}