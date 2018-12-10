<?php

namespace app\Robot\Battery;

class Battery
{
    protected $power;

    public function __construct(float $power)
    {
        $this->power = $power;
    }

    public function getPower(): float
    {
        return $this->power;
    }

/*    public function setPower(float $power): void
    {
        $this->power = $power;
    }*/

    public function consumePowerUnit(float $unit): bool
    {
        $result = $this->power - $unit;
        if ($result < 0) {
            throw new PowerException();
        }
        $this->power =$result ;
        return true;
    }
}