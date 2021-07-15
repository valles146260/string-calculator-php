<?php

namespace Deg540\StringCalculatorPHP;

abstract class DelimitersRule
{
    public abstract function extractNumbers(string $string): ?Numbers;

    protected function extractNumbersByDelimiters(Delimiters $delimiters, string $string): Numbers
    {
        $numbers[] = $string;
        foreach ($delimiters->toStringArray() as $delimiter) {
            for ($i=0; $i < count($numbers); $i++) {
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