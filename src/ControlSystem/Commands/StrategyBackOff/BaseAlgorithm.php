<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 24.11.2018
 * Time: 21:48
 */

namespace app\ControlSystem\Commands\StrategyBackOff;

use app\ControlSystem;
use app\ControlSystem\Commands\Back;
use app\ControlSystem\Commands\Forward;
use app\Navigation\WallException;

abstract class BaseAlgorithm
{
    /**
     * @var Strategy
     */
    protected $successor;

    public function setNext(Strategy $strategy)
    {
        $this->successor = $strategy;
    }


    public function tryForward(ControlSystem $control)
    {
        try {
            (new Forward($control))->execute();
        } catch (WallException $e) {
            if ($this->successor) {
                $this->successor->doAlgorithm($control);
            } else {
                throw new StrategyException();
            }
        }
    }

    public function tryBack(ControlSystem $control)
    {
        try {
            (new Back($control))->execute();
        } catch (WallException $e) {
            if ($this->successor) {
                $this->successor->doAlgorithm($control);
            } else {
                throw new StrategyException();
            }
        }
    }
}