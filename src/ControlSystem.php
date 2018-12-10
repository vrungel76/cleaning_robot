<?php


namespace app;

use app\ControlSystem\Commands\CommandInterface;
use app\ControlSystem\Commands\StrategyBackOff\StrategyControl;
use app\ControlSystem\Commands\Clean;
use app\ControlSystem\Commands\Forward;
use app\ControlSystem\Commands\Left;
use app\ControlSystem\Commands\Right;
use app\ControlSystem\Commands\StrategyBackOff\StrategyException;
use app\ControlSystem\State\StateObject;
use app\Decorator\Model\Output;
use app\Navigation\MapController;
use app\Navigation\WallException;
use app\Robot\Battery\PowerException;


class ControlSystem
{

    private $commandMediator = [
        'TL' => Left::class,
        'TR' => Right::class,
        'A' => Forward::class,
        'C' => Clean::class
    ];

    private $map;
    private $state;

    public function __construct(MapController $map, StateObject $state)
    {
        $this->map = $map;
        $this->state = $state;
    }


    public function doCommand(string $inputCommand): bool
    {
        if (!isset($this->commandMediator[$inputCommand])) {
            return false;
        }
        /** @var CommandInterface $command */
        $command = new $this->commandMediator[$inputCommand]($this);
        try {
            $command->execute();
        } catch (WallException $e) {

            try {
                return $this->runStrategy();
            } catch (StrategyException | PowerException $e) {
                return false;
            }

        } catch (PowerException $e) {
            return false;
        }

        return true;
    }

    private function runStrategy()
    {
       return (new StrategyControl())->run($this);
    }

    public function getData(): string
    {
        return (new Output($this))->toString();
    }


    public function getState(): StateObject
    {
        return $this->state;
    }

    public function getMap(): MapController
    {
        return $this->map;
    }



}