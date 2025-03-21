<?php

namespace Deg540\StringCalculatorPHP;

class StringCalculator
{
    public function add(string $number): int
    {
        $number = $this->getCleanCode($number);

        if ($this->isMoreOfOneNumber($number)) {
            return array_sum(array_map('intval', $number)); // Asegura que sean enteros
        }

        if ($this->isOnlyOneNumber($number)) {
            return intval($number[0]); // Convierte explícitamente a entero
        }

        return 0;
    }

    /**
     * @param string $number
     * @return string[]
     */
    public function getCleanCode(string $number): array
    {
        $number = str_replace("\n", ",", $number);

        $number = explode(",", $number);

        return $number; // Separa la cadena por ','
    }

    /**
     * @param array $number
     * @return bool
     */
    public function isMoreOfOneNumber(array $number): bool
    {
        return count($number) > 1;
    }

    /**
     * @param array $number
     * @return bool
     */
    public function isOnlyOneNumber(array $number): bool
    {
        return count($number) == 1;
    }

}