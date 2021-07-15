<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP;

class Delimiters {
    /**
     * @var string[]
     */
    private array $delimiters;

    /**
     * @param string[] $delimiters
     */
    public function __construct(array $delimiters = [])
    {
        $this->delimiters = $delimiters;
    }

    public function add(string $delimiter): void
    {
        $this->delimiters[] = $delimiter;
    }

    /**
     * @return string[]
     */
    public function toStringArray(): array
    {
        return $this->delimiters;
    }
}