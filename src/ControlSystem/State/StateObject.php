<?php

namespace app\ControlSystem\State;

class StateObject
{
    private $compass = ['N', 'E', 'S', 'W'];

    public $face;
    public $x;
    public $y;

    /**
     * @var \app\Robot\Battery\Battery
     */
    public $battery;

    /**
     * @var \app\Navigation\ItemXY[]
     */
    public $visited = [];
    /**
     * @var \app\Navigation\ItemXY[]
     */
    public $cleaned = [];



    public function turnFace(int $delta): void
    {
        $key = array_keys($this->compass, $this->face);
        $newKey = $key[0] + $delta;

        if (!isset($this->compass[$newKey])) {
            if ($newKey > 3) {
                $newKey = 0;
            }
            if ($newKey < 0) {
                $newKey = 3;
            }
        }
        $this->face =  $this->compass[$newKey];
    }



}