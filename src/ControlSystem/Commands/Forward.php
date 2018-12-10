<?php

namespace app\ControlSystem\Commands;

use app\ControlSystem;
use app\Navigation\ItemXY;


class Forward implements CommandInterface
{
    protected $powerUnit = 2;
    protected $control;

    public function __construct(ControlSystem $control)
    {
        $this->control = $control;
    }

    public function execute()
    {
        $state = $this->control->getState();
        $nextPosition = $this->control->getMap()->getNextItem($state->y, $state->x, $state->face);

        $state->battery->consumePowerUnit($this->powerUnit);

        $state->x = $nextPosition->x;
        $state->y = $nextPosition->y;

        $state->visited[] = new ItemXY($state->y, $state->x);

        return true;
    }

}