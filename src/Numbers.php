<?php

namespace Deg540\StringCalculatorPHP;

class Numbers
{
    private array $numbers = [];

    public function create(array $numbers): void
    {
        $this->numbers = $numbers;
    }

    public function toArrayOfIntegers(): array
    {
        return array_map("intval", $this->numbers);
    }
}