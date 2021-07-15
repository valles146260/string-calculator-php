<?php

namespace Deg540\StringCalculatorPHP;

abstract class DelimitersRule
{
    public abstract function extractNumbers(string $string): ?Numbers;

    protected function extractNumbersByDelimiters(Delimiters $delimiters, string $string): Numbers
    {
        $numbers[] = $string;
        foreach ($delimiters->getDelimiters() as $delimiter) {
            foreach ($numbers as $number) {
                $piece = array_shift($numbers);

                if ($delimiter === "") {
                    $numbers = array_merge($numbers, str_split($piece));
                } else {
                    $numbers = array_merge($numbers, explode($delimiter, $piece));
                }
            }
        }

        return new Numbers(array_map('intval', $numbers));
    }
}