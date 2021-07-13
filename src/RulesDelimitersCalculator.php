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

    public function processString(string $string): ProcessedString
    {
        $processedString = new ProcessedString();
        $delimiters = new Delimiters();

        foreach ($this->rules as $rule)
        {
            $ruleProcessedString = $rule->extractDelimiters($string);
            if (!$ruleProcessedString->isEmpty()) {
                $processedString = $ruleProcessedString;
            }
        }
        if ($processedString->isEmpty())
        {
            $delimiters->update(self::DEFAULT_DELIMITERS);
            $processedString->setDelimiters($delimiters);
            $processedString->processNumbers($string);
        }

        return $processedString;
    }
}