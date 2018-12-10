<?php

namespace app\ControlSystem\Commands;

use app\ControlSystem;
use app\Navigation\ItemXY;


class Back implements CommandInterface
{
    protected $powerUnit = 3;
    protected $control;

    public function __construct(ControlSystem $control)
    {
        $this->control = $control;
    }

    public function execute()
    {
        $state = $this->control->getState();
        $map = $this->control->getMap();

        $newFace = $map->getBackFace($state->face);
        $nextPosition = $map->getNextItem($state->y, $state->x, $newFace);

        $state->battery->consumePowerUnit($this->powerUnit);

        $state->x = $nextPosition->x;
        $state->y = $nextPosition->y;
        $state->face = $newFace;

        $state->visited[] = new ItemXY($state->y, $state->x);

        return true;
    }

}