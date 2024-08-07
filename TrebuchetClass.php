<?php
// TrebuchetClass for day #1 exercises

class TrebuchetClass
{
    private $lines = [];
    private $versionDay = false;
    private $words = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

    public function __construct($filename, $versionDay = 1)
    {
        // loads file content into an array to process each text file line
        $this->lines = file($filename);
        // define the exercise version
        $this->versionDay = $versionDay;
    }

    public function setVersion($number)
    {
        $this->versionDay = $number;
    }

    // remove characters, we only need to get/process digits
    private function removeChars($content)
    {
        return preg_replace("/[^0-9]/", "", $content);
    }

    // replace number names with digits
    private function replaceWords($line)
    {
        // keep some name strings to keep name overlapping, for example nineight, oneight, twone or eightwo
        $numbers = ['o1e', 't2o', '3e', '4r', '5e', '6', '7n', '8t', 'n9'];
        $replaced =  str_replace($this->words, $numbers, $line);

        return $replaced;
    }

    // convert digits to int value
    private function toInt($char)
    {
        return is_numeric($char) ? intval($char) : null;
    }

    // get the first and last digits, in a most efficient way
    private function withReplace($line)
    {
        // remove characters from string
        $line = $this->removeChars($line);

        // once we got only numbers on string
        // get first char on string
        $firstDigit = intval($line[0]);
        // get last char on string
        $lastDigit = intval($line[strlen($line) - 1]);

        return intval($firstDigit . $lastDigit);
    }

    // check if the string is has a number name and returns its digit
    private function isNumberString($str)
    {
        foreach ($this->words as $i => $numberWord) {
            $found = strpos($str, $numberWord);
            if ($found !== false) {
                return $i + 1;
            }
        }

        return null;
    }

    // gets the first and last digit of the string using a loop, instead of a text string replace
    // created just to demostrate how could it be done with a loop managing strings forward and backward
    private function withLoop($line)
    {
        // initalize required variables
        $firstDigit = $lastDigit = null;
        $backwardString = $forwardString = $line;
        $beginWord = '';
        $endWord = '';
        // start loop while first or last digit aren't found
        while ($firstDigit === null || $lastDigit === null) {
            // if firstDigit isn't found, search for it
            if ($firstDigit === null) {
                // get first char of string
                $char = $forwardString[0];
                // convert to integer digit if is a number
                $firstDigit = $this->toInt($char);
                // if is a character, append to a string to search a number name on it
                if ($firstDigit === null) {
                    $beginWord .= $char;
                    // search for a digit on string
                    $firstDigit = $this->isNumberString($beginWord);
                }

                // remove first char from string to continue evaluating
                $forwardString = substr($forwardString, 1, strlen($forwardString) - 1);
            }

            // if lastDigit isn't found, search for it
            if ($lastDigit === null) {
                // get last char of string
                $char = $backwardString[strlen($backwardString) - 1];
                // convert to integer digit if is a number
                $lastDigit = $this->toInt($char);
                // if is a character, adds to a string to search last number name
                if ($lastDigit === null) {
                    $endWord = $char . $endWord;
                    // search for a digit on string
                    $lastDigit = $this->isNumberString($endWord);
                }

                // remove last char from string to continue evaluating
                $backwardString = substr($backwardString, 0, -1);
            }
        }

        return intval($firstDigit . $lastDigit);
    }

    // evaluate each line to get the number
    public function getTotalCalibrationValues($replace = true)
    {
        $sumCalibrationValues = 0;
        foreach ($this->lines as $i => $originLine) {
            // remove newline characters from textline
            $originLine = trim(preg_replace('/\s\s+/', ' ', $originLine));

            // for exercise #1 of the day should evaluate only digits on the line
            // for exercise #2 should also evaluate number names, use replaceWords method to 
            // convert number names to digits.
            $line = $this->versionDay === 1 ? $originLine : $this->replaceWords($originLine);

            // decide which algoritm use to calculate
            // use text replace algorithm by default (most efficient)
            $digit = $replace ? $this->withReplace($line) : $this->withLoop($line);

            $sumCalibrationValues += $digit;
        }

        return $sumCalibrationValues;
    }
}
