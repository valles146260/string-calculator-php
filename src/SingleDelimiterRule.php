<?php

namespace Deg540\StringCalculatorPHP;

class SingleDelimiterRule implements IDelimitersRule
{
    public function extractDelimiters(string $string): ProcessedString
    {
        $processedString = new ProcessedString();
        $delimiters = new Delimiters();
        if ($this->isSingleCharacterDelimiter($string)) {
            $delimiters->delete();
            $delimiters->add($this->extractDelimiter($string));
            $processedString->setDelimiters($delimiters);
            $processedString->processNumbers($this->extractNumbers($string));
        }

        return $processedString;
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