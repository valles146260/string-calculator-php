<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{
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
        $number = strtok($numbers, $delimiter);
        while ($number !== false) {
            $add += intval($number);
            $number = strtok($delimiter);
        }
        return $add;
    }
}