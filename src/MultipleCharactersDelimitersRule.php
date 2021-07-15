<?php

namespace Deg540\StringCalculatorPHP;

class MultipleCharactersDelimitersRule extends DelimitersRule
{
    private int $delimiterStartPosition;
    private int $delimiterEndPosition;
    private int $delimiterLength;

    public function extractNumbers(string $string): ?Numbers
    {
        if ($this->hasMultipleCharacterDelimiter($string)) {
            $delimiters = new Delimiters($this->extractDelimiters($string));
            $string = $this->extractNumbersString($string);
            return $this->extractNumbersByDelimiters($delimiters, $string);
        }

        return null;
    }

    private function hasMultipleCharacterDelimiter(string $string): bool
    {
        return preg_match("/\/\/(\[[^]]*\])*\n.*/", $string);
    }

    /**
     * @return string[]
     */
    private function extractDelimiters(string $string): array
    {
        $delimiters = [];
        $this->calculatePositions($string);
        while ($this->delimiterEndPosition !== -1) {
            $delimiters[] = substr($string, $this->delimiterStartPosition, $this->delimiterLength);
            $string = substr($string, $this->delimiterEndPosition);
            $this->calculatePositions($string);
        }
        return $delimiters;
    }

    private function extractNumbersString(string $string): string
    {
        $this->calculateEndPosition($string);
        while ($this->delimiterEndPosition !== -1) {
            $string = substr($string, $this->delimiterEndPosition);
            $this->calculateEndPosition($string);
        }
        return $string;
    }

    private function calculatePositions($string): void
    {
        $this->calculateStartPosition($string);
        $this->calculateEndPosition($string);
        $this->calculateLength($string);
    }

    private function calculateStartPosition($string): void
    {
        if (!str_contains($string, '[')) {
            $this->delimiterStartPosition = -1;
        } else {
            $this->delimiterStartPosition = strpos($string, '[') + 1;
        }
    }

    private function calculateEndPosition($string): void
    {
        if (!str_contains($string, ']')) {
            $this->delimiterEndPosition = -1;
        } else {
            $this->delimiterEndPosition = strpos($string, ']') + 1;
        }
    }

    private function calculateLength($string): void
    {
        if (!str_contains($string, '[') || !str_contains($string, ']')) {
            $this->delimiterLength = -1;
        } else {
            $this->delimiterLength = ($this->delimiterEndPosition - 1) - $this->delimiterStartPosition;
        }
    }
}