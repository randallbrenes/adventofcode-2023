<?php
// CubeConundrumClass for day #2 exercises

require_once('CubeConundrumGameClass.php');

class CubeConundrumClass
{

    private $lines = [];
    private $gamesSet = [];
    private $maxRed = 0;
    private $maxBlue = 0;
    private $maxGreen = 0;

    public function __construct($filename)
    {
        // loads file content into an array to process each text file line
        $this->lines = file($filename);
        // create each game sets of cubes
        foreach ($this->lines as $gameLine) {
            $this->gamesSet[] = new CubeConundrumGameClass($gameLine);
        }
    }

    public function setMaxValues($r, $g, $b)
    {
        // define max number of cubes by color
        $this->maxRed = $r;
        $this->maxGreen = $g;
        $this->maxBlue = $b;
    }

    public function exercise1()
    {
        // goes through the array of gamesSets and validate if it meets the requirement
        return array_reduce($this->gamesSet, function ($sum, $game) {
            if ($game->isValid($this->maxRed, $this->maxGreen, $this->maxBlue)) {
                $sum += $game->getNumber();
            }
            return $sum;
        }, 0);
    }

    public function exercise2()
    {
        // goes through the array of gamesSets and computes the power
        return array_reduce($this->gamesSet, function ($sum, $game) {
            return $sum + $game->getPower();
        }, 0);
    }
}
