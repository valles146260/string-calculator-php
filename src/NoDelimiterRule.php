<?php

namespace Deg540\StringCalculatorPHP;

class NoDelimiterRule extends DelimitersRule
{
    const DEFAULT_DELIMITERS = [",", "\n"];

    public function extractNumbers(string $string): ?Numbers
    {
        if ($this->isNoDelimiter($string)) {
            $delimiters = new Delimiters(self::DEFAULT_DELIMITERS);
            return $this->extractNumbersByDelimiters($delimiters, $string);
        }

        return null;
    }

    private function isNoDelimiter(string $string): bool
    {
        return preg_match("/^(?!\/\/.*\n).*/", $string);
    }
}