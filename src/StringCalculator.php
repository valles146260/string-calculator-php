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
            new DefaultDelimitersRule(),
            new SingleCharacterDelimiterRule(),
            new MultipleCharactersDelimitersRule()
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
            $numbers = $delimitersRule->extractNumbers($numbersString);
            if (!empty($numbers)) {
                break;
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
        foreach ($numbers->getNumbers() as $number) {
            $total += $number;
        }

        return $total;
    }
}