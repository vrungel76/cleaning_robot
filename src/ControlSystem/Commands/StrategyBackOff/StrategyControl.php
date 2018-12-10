<?php

namespace app\ControlSystem\Commands\StrategyBackOff;

use app\ControlSystem;

class StrategyControl
{
    public function run(ControlSystem $control)
    {
        $first = new Algorithm1();
        $second = new Algorithm2();
        $third = new Algorithm3();
        $fourth = new Algorithm4();
        $fifth = new Algorithm5();

        $first->setNext($second);
        $second->setNext($third);
        $third->setNext($fourth);
        $fourth->setNext($fifth);

        $first->doAlgorithm($control);

        return true;
    }

}