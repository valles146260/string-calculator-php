<?php

namespace Deg540\StringCalculatorPHP;

interface IDelimitersCalculator
{
    public function delimitersCalculator(string $string): array;
}