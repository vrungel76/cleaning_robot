<?php

namespace app\Decorator\Model;

use app\Decorator\Decorator;

class Output extends Decorator
{
    /**
     * @var \app\ControlSystem
     */
    protected $entity;

    public function toString(): string
    {
        return json_encode([
            'visited'   => $this->getVisited(),
            'cleaned'   => $this->getCleaned(),
            'final'     => $this->getFinal(),
            'battery'   => $this->entity->getState()->battery->getPower(),
        ]);
    }


    private function getVisited()
    {
        $result = [];
        $arr = $this->entity->getState()->visited;
        /** @var \app\Navigation\ItemXY $obj */
        foreach ($arr as $obj) {
            $result[] = [
                'X' => $obj->x,
                'Y' => $obj->y
            ];
        }
        return $result;
    }

    private function getCleaned()
    {
        $result = [];
        $arr = $this->entity->getState()->cleaned;
        /** @var \app\Navigation\ItemXY $obj */
        foreach ($arr as $obj) {
            $result[] = [
                'X' => $obj->x,
                'Y' => $obj->y
            ];
        }
        return $result;
    }

    private function getFinal()
    {
        $state = $this->entity->getState();
        return ['X' => $state->x, 'Y' => $state->y, 'facing' => $state->face];

    }


}