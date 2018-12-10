<?php

namespace app\ControlSystem\Commands;

class Right extends Command
{
    protected $powerUnit = 1;
    protected $turn = 1;

    public function execute()
    {
        parent::execute();
        $state = $this->control->getState();
        $state->turnFace($this->turn);
    }
}