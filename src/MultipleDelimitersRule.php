<?php

namespace Deg540\StringCalculatorPHP;

class MultipleDelimitersRule implements IDelimitersRule
{
    private Delimiters $delimiters;
    private ProcessedString $processedString;
    private int $delimiterStartPosition;
    private int $delimiterEndPosition;
    private int $delimiterLength;

    public function __construct()
    {
        $this->processedString = new ProcessedString();
        $this->delimiters = new Delimiters();
    }

    public function extractDelimiters(string $string): ProcessedString
    {
        if ($this->isMultipleCharacterDelimiter($string)) {
            $this->delimiters->delete();
            $this->addDelimiters($string);
        }

        return $this->processedString;
    }

    private function isMultipleCharacterDelimiter(string $string): bool
    {
        return preg_match("/\/\/(\[[^]]*\])*\n.*/", $string);
    }

    private function addDelimiters(string $string): void
    {
        $this->calculatePositions($string);
        while ($this->delimiterEndPosition !== -1) {
            $this->delimiters->add(substr($string, $this->delimiterStartPosition, $this->delimiterLength));
            $string = substr($string, $this->delimiterEndPosition);
            $this->calculatePositions($string);
        }
        $this->processedString->setDelimiters($this->delimiters);
        $this->processedString->processNumbers($string);
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