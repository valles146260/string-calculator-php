<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{
    public function add(string $numbers): int
    {
        if ($numbers === "") {
            return 0;
        }
        $add = 0;
        foreach (explode(",", $numbers) as &$number) {
            $add += intval($number);
        }
        return $add;
    }
}