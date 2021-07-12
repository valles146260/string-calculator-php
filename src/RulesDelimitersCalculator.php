<?php

namespace Deg540\StringCalculatorPHP;

class RulesDelimitersCalculator implements IDelimitersCalculator
{
    const DEFAULT_DELIMITERS = [",", "\n"];

    private array $rules = [];

    public function __construct()
    {
        $this->rules[] = new SingleDelimiterRule();
        $this->rules[] = new MultipleDelimitersRule();
    }

    public function delimitersCalculator(string $string): array
    {
        $delimiters = new Delimiters();

        foreach ($this->rules as $rule)
        {
            $extractedDelimiters = $rule->extractDelimiters($string);
            if (!empty($extractedDelimiters))
            {
                $delimiters->update($extractedDelimiters);
            }
        }
        if ($delimiters->isEmpty())
        {
            $delimiters->update(self::DEFAULT_DELIMITERS);
            $delimiters->add($string);
        }

        return $delimiters->toArray();
    }
}