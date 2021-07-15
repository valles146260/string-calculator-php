<?php

namespace Deg540\StringCalculatorPHP;

use Exception;

class StringCalculator
{
    /**
     * @var DelimitersRule[]
     */
    private array $delimitersRules;

    /**
     * @var NumbersRule[]
     */
    private array $numbersRules;

    public function __construct()
    {
        $this->delimitersRules = [
            new NoDelimiterRule(),
            new SingleDelimiterRule(),
            new MultipleDelimitersRule()
        ];
        $this->numbersRules = [
            new NoNegativesRule(),
            new MaxNumberRule()
        ];
    }

    /**
     * @throws Exception
     */
    public function add(string $numbersString): int
    {
        if (empty($numbersString)) {
            return 0;
        }

        $numbers = new Numbers();
        foreach ($this->delimitersRules as $delimitersRule)
        {
            $extractedNumbers = $delimitersRule->extractNumbers($numbersString);
            if (!empty($extractedNumbers)) {
                $numbers = $extractedNumbers;
            }
        }
        foreach ($this->numbersRules as $numbersRule)
        {
            $numbers = $numbersRule->checkNumbers($numbers);
        }

        return $this->addNumbers($numbers);
    }

    private function addNumbers(Numbers $numbers): int
    {
        $total = 0;
        foreach ($numbers->toIntArray() as $number) {
            $total += $number;
        }

        return $total;
    }
}