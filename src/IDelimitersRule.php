<?php

namespace Deg540\StringCalculatorPHP;

interface IDelimitersRule
{
    public function extractDelimiters(string $string): ProcessedString;
}