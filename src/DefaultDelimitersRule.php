<?php

namespace Deg540\StringCalculatorPHP;

class DefaultDelimitersRule extends DelimitersRule
{
    const DEFAULT_DELIMITERS = [",", "\n"];

    public function extractNumbers(string $string): ?Numbers
    {
        if ($this->hasNoDelimiter($string)) {
            $delimiters = new Delimiters(self::DEFAULT_DELIMITERS);
            return $this->extractNumbersByDelimiters($delimiters, $string);
        }

        return null;
    }

    private function hasNoDelimiter(string $string): bool
    {
        return preg_match("/^(?!\/\/.*\n).*/", $string);
    }
}