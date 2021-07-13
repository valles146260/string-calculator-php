<?php

namespace Deg540\StringCalculatorPHP;

use Exception;

class StringCalculator
{
    const MAX_NUMBER_ALLOWED = 1000;

    /**
     * @throws Exception
     */
    public function add(string $numbers): int
    {
        if (empty($numbers)) {
            return 0;
        }
        $processedString= $this->extractDelimiters($numbers);
        $numbers = $processedString->getNumbers()->toArrayOfIntegers();

        return $this->operate($numbers);
    }

    private function extractDelimiters(string $string): ProcessedString
    {
        $delimitersCalculator = new RulesDelimitersCalculator();

        return $delimitersCalculator->processString($string);
    }

    /**
     * @throws Exception
     */
    private function operate(array $numbers): int
    {
        $total = 0;

        $this->checkNegatives($numbers);
        foreach ($numbers as $number) {
            if ($number <= self::MAX_NUMBER_ALLOWED) {
                $total += $number;
            }
        }

        return $total;
    }

    /**
     * @throws Exception
     */
    private function checkNegatives(array $numbers): void
    {
        $negatives = [];

        foreach ($numbers as $number) {
            if ($number < 0) {
                $negatives[] = $number;
            }
        }

        if (count($negatives)) {
            throw new Exception("Negativos no soportados: " . implode(", ", $negatives));
        }
    }
}