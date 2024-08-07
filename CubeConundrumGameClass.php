<?php
// CubeConundrumGameClass for day #2 exercises

class CubeConundrumGameClass
{
    private $number; // game number
    // cubes colors
    private $colors = [
        'red', 'blue', 'green'
    ];
    // stores the maximun number of cubes by color
    private $max = ['red' => 0, 'blue' => 0, 'green' => 0];
    private $sets = [];

    public function __construct($gameLine)
    {
        // splits line into game number part and game stats
        list($gamePart, $setsPart) = explode(':', $gameLine);
        // extract the game number
        $this->number = $this->getGameNumber($gamePart);
        // computes game sets
        $this->setGameSets($setsPart);
    }

    private function getGameNumber($str)
    {
        $matches = [];
        // regex to get the digits
        preg_match('/game ([0-9]+)/i', $str, $matches);
        return $matches[1];
    }

    public function getNumber()
    {
        // returns game number
        return $this->number;
    }

    private function setGameSets($setsPart)
    {
        $sets = explode(';', $setsPart);
        // gets each set stats
        foreach ($sets as $set) {
            $result = [];
            // regex to split into separate arrays the colors and the number of cubes
            preg_match_all('/([0-9]+) (' . join('|', $this->colors) . ')/i', $set, $result);

            $numbers = $result[1];
            $colors = $result[2];

            $set = [];
            foreach ($numbers as $i => $number) {
                $color = $colors[$i];
                $set[$color] = $number;
                // stores the maximun number of cubes by color on each game
                if ($number > $this->max[$color])
                    $this->max[$color] = $number;
            }

            $this->sets[] = $set;
        }
    }

    private function validRed($number)
    {
        return $this->max['red'] <= $number;
    }

    private function validGreen($number)
    {
        return $this->max['green'] <= $number;
    }

    private function validBlue($number)
    {
        return $this->max['blue'] <= $number;
    }

    public function isValid($r, $g, $b)
    {
        return $this->validRed($r) && $this->validGreen($g) && $this->validBlue($b);
    }

    public function getPower()
    {
        /*
            The power of a set of cubes is equal to the numbers of
            red, green, and blue cubes multiplied together.
        */
        // multiply all values on array
        return array_product($this->max);
    }
}
