<?php

namespace app\Navigation;

class ItemXY
{
    public $x;
    public $y;

    public function __construct(int $y, int $x)
    {
        $this->x = $x;
        $this->y = $y;
    }
}