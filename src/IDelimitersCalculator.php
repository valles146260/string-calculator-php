<?php

namespace Deg540\StringCalculatorPHP;

interface IDelimitersCalculator
{
    public function processString(string $string): ProcessedString;
}