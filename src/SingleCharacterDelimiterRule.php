<?php

namespace Deg540\StringCalculatorPHP;

class SingleCharacterDelimiterRule extends DelimitersRule
{
    public function extractNumbers(string $string): ?Numbers
    {
        if ($this->hasSingleCharacterDelimiter($string)) {
            $delimiters = new Delimiters();
            $delimiters->add($this->extractDelimiter($string));
            $string = $this->extractNumbersString($string);
            return $this->extractNumbersByDelimiters($delimiters, $string);
        }

        return null;
    }

    private function hasSingleCharacterDelimiter(string $string): bool
    {
        return preg_match("/\/\/.\n.*/", $string);
    }

    private function extractDelimiter(string $string): string
    {
        return substr($string, 2, 1);
    }

    private function extractNumbersString(string $string): string
    {
        return substr($string, 4);
    }
}