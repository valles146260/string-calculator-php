<?php

namespace Deg540\StringCalculatorPHP;

class ProcessedString
{
    private Delimiters $delimiters;
    private Numbers $numbers;

    public function __construct()
    {
        $this->delimiters = new Delimiters();
        $this->numbers = new Numbers();
    }

    public function setDelimiters(Delimiters $delimiters): void
    {
        $this->delimiters = $delimiters;
    }

    public function processNumbers(string $numbers): void
    {
        $splitNumbers[] = $numbers;
        foreach ($this->delimiters->toArray() as $delimiter) {
            for ($i=0; $i < count($splitNumbers); $i++) {
                $piece = array_shift($splitNumbers);

                if ($delimiter === "") {
                    $splitNumbers = array_merge($splitNumbers, str_split($piece));
                } else {
                    $splitNumbers = array_merge($splitNumbers, explode($delimiter, $piece));
                }
            }
        }

        $this->numbers->create($splitNumbers);
    }

    public function getNumbers(): Numbers
    {
        return $this->numbers;
    }

    public function isEmpty(): bool
    {
        return $this->delimiters->isEmpty();
    }
}