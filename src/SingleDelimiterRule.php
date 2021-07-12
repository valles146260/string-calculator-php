<?php

namespace Deg540\StringCalculatorPHP;

class SingleDelimiterRule implements IDelimitersRule
{
    private Delimiters $delimiters;

    public function __construct()
    {
        $this->delimiters = new Delimiters();
    }

    public function extractDelimiters(string $string): array
    {
        if ($this->isSingleCharacterDelimiter($string)) {
            $this->delimiters->delete();
            $this->delimiters->add($this->extractDelimiter($string));
            $this->delimiters->add($this->extractNumbers($string));
        }

        return $this->delimiters->toArray();
    }

    private function isSingleCharacterDelimiter(string $string): bool
    {
        return preg_match("/\/\/.\n.*/", $string);
    }

    private function extractDelimiter(string $string): string
    {
        return substr($string, 2, 1);
    }

    private function extractNumbers(string $string): string
    {
        return substr($string, 4);
    }
}