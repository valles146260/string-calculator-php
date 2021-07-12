<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP;

class Delimiters {
    private array $delimiters = [];

    public function add(string $delimiter): void
    {
        $this->delimiters[] = $delimiter;
    }

    public function update(array $delimiters): void
    {
        $this->delimiters = $delimiters;
    }

    public function toArray(): array
    {
        return $this->delimiters;
    }

    public function delete(): void
    {
        $this->delimiters = [];
    }

    public function isEmpty(): bool
    {
        return count($this->delimiters) === 0;
    }
}