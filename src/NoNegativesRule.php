<?php

namespace Deg540\StringCalculatorPHP;

use Exception;

class NoNegativesRule implements NumbersRule
{
    /**
     * @throws Exception
     */
    public function checkNumbers(Numbers $numbers): Numbers
    {
        $negatives = [];
        foreach ($numbers->toIntArray() as $number) {
            if ($number < 0) {
                $negatives[] = $number;
            }
        }
        if (count($negatives)) {
            throw new Exception("Negativos no soportados: " . implode(", ", $negatives));
        }

        return $numbers;
    }
}