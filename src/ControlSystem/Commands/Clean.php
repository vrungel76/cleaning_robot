<?php

namespace app\ControlSystem\Commands;

use app\Navigation\ItemXY;

class Clean extends Command
{
    protected $powerUnit = 5;

    public function execute()
    {
        parent::execute();
        $state = $this->control->getState();
        $state->cleaned[] = new ItemXY($state->y, $state->x);
    }
}