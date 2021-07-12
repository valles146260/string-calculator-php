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
        $delimiters = $this->extractDelimiters($numbers);
        $numbers = array_pop($delimiters);

        return $this->operate($numbers, $delimiters);
    }

    private function extractDelimiters(string $string): array
    {
        $delimitersCalculator = new RulesDelimitersCalculator();

        return $delimitersCalculator->delimitersCalculator($string);
    }

    /**
     * @throws Exception
     */
    private function operate(string $numbers, array $delimiters): int
    {
        $splitNumbers = $this->split($numbers, $delimiters);

        return $this->getTotal($splitNumbers);
    }

    private function split(string $numbers, array $delimiters): array
    {
        $splitNumbers[] = $numbers;

        foreach ($delimiters as $delimiter) {
            for ($i=0; $i < count($splitNumbers); $i++) {
                $piece = array_shift($splitNumbers);

                if ($delimiter === "") {
                    $splitNumbers = array_merge($splitNumbers, str_split($piece));
                } else {
                    $splitNumbers = array_merge($splitNumbers, explode($delimiter, $piece));
                }
            }
        }

        return $splitNumbers;
    }

    /**
     * @throws Exception
     */
    private function getTotal(array $numbers): int
    {
        $total = 0;

        $numbers = array_map("intval", $numbers);
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