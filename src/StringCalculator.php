<?php

namespace Deg540\StringCalculatorPHP;

use Exception;

class StringCalculator
{
    private array $defaultDelimiters = [",", "\n"];

    /**
     * @throws Exception
     */
    public function add(string $numbers): int
    {
        if ($numbers === "") {
            return 0;
        }

        $delimiters = $this->extractDelimiters($numbers);
        $splitNumbers = $this->split($numbers, $delimiters);

        return $this->textAddition($splitNumbers);
    }

    private function extractDelimiters(string &$string): array
    {
        $delimiters = $this->defaultDelimiters;

        if (preg_match("/\/\/.\n.*/", $string)) {
            $delimiters[] = substr($string, 2, 1);
            $string = substr($string, 4);
        }
        if (preg_match("/\/\/\[.*\]\n.*/", $string)) {
            $delimiterEndPosition = strrpos($string, ']');
            $delimiters[] = substr($string, 3, $delimiterEndPosition - 3);
            $string = substr($string, $delimiterEndPosition + 2);
        }

        return $delimiters;
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
    private function textAddition(array $numbers): int
    {
        $total = 0;

        $numbers = $this->stringToIntArray($numbers);
        $this->checkNegatives($numbers);
        foreach ($numbers as $number) {
            if ($number <= 1000) {
                $total += $number;
            }
        }

        return $total;
    }

    private function stringToIntArray(array $stringArray): array
    {
        $intArray = [];

        foreach ($stringArray as $value) {
            $intArray[] = intval($value);
        }

        return $intArray;
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