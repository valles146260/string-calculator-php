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
        if ($numbers->hasNegatives()) {
            throw new Exception("Negativos no soportados: " . implode(", ", $numbers->getNegatives()));
        }

        return $numbers;
    }
}