<?php

namespace Deg540\StringCalculatorPHP;

class MaxNumberRule implements NumbersRule
{
    const MAX_NUMBER_ALLOWED = 1000;

    public function checkNumbers(Numbers $numbers): Numbers
    {
        $checkedNumbers = new Numbers();
        foreach ($numbers->toIntArray() as $number) {
            if ($number <= self::MAX_NUMBER_ALLOWED) {
                $checkedNumbers->add($number);
            }
        }

        return $checkedNumbers;
    }
}