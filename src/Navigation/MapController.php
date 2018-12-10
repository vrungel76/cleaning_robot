<?php

namespace app\Navigation;

class MapController
{
    /**
     * @var MapItem[]
     */
    private $mapItems = [];

    private $mapRaw;

    public function __construct(array $map)
    {
        $this->mapRaw = $map;
        $this->processMap();
    }

    /**
     * @param int $x
     * @param int $y
     * @param string $face
     * @return ItemXY
     * @throws WallException
     */
    public function getNextItem(int $y, int $x, string $face): ItemXY
    {
        $item = $this->mapItems["{$y}{$x}"];
        if ($item->{$face} === null) {
            throw new WallException;
        }
        return $item->{$face};
    }


    public function getBackFace(string $face): string
    {
        $newFace  = '';
        switch ($face) {
            case 'N':
                $newFace = 'S';
                break;
            case 'E':
                $newFace = 'W';
                break;
            case 'S':
                $newFace = 'N';
                break;
            case 'W':
                $newFace = 'E';
                break;
        }
        return $newFace;
    }


    private function processMap(): void
    {
        foreach ($this->mapRaw as $y => $row) {
            $n = $y - 1;
            $s = $y + 1;

            foreach ($row as $x => $value) {
                $e = $x + 1;
                $w = $x - 1;

                $mapper = new MapItem();
                $mapper->value = $value;

                if (isset($this->mapRaw[$y][$e])) {
                    if ($this->mapRaw[$y][$e] != "C") {
                        $mapper->E = new ItemXY($y, $e);
                    }
                }
                if (isset($this->mapRaw[$y][$w])) {
                    if ($this->mapRaw[$y][$w] != "C") {
                        $mapper->W = new ItemXY($y, $w);
                    }
                }
                if (isset($this->mapRaw[$n][$x])) {
                    if ($this->mapRaw[$n][$x] != "C") {
                        $mapper->N = new ItemXY($n, $x);
                    }
                }
                if (isset($this->mapRaw[$s][$x])) {
                    if ($this->mapRaw[$s][$x] != "C") {
                        $mapper->S = new ItemXY($s, $x);
                    }
                }

                $this->mapItems["{$y}{$x}"] = $mapper;
            }
        }
    }

}