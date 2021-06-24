<?php

namespace Deg540\StringCalculatorPHP;

use Exception;

class StringCalculator
{
    /**
     * @throws Exception
     */
    public function add(string $numbers): int
    {
        if ($numbers === "") {
            return 0;
        }
        $delimiter = ",\n";
        if (preg_match("/\/\/.\n.*/", $numbers)) {
            $delimiter = substr($numbers, 2, 1);
            $numbers = substr($numbers, 4);
        }
        $add = 0;
        $negatives = array();
        $number = strtok($numbers, $delimiter);
        while ($number !== false) {
            $numberValue = intval($number);
            if ($numberValue < 0) {
                array_push($negatives, $numberValue);
            }
            $add += $numberValue;
            $number = strtok($delimiter);
        }
        if (count($negatives)) {
            throw new Exception("Negativos no soportados: " . implode(", ", $negatives));
        }
        return $add;
    }
}