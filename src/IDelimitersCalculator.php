<?php

namespace Deg540\StringCalculatorPHP;

interface IDelimitersCalculator
{
    public function calculateDelimiters(string $string): array;
}