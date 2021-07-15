<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP;

class Numbers {
    /**
     * @var int[]
     */
    private array $numbers;

    /**
     * @param int[] $numbers
     */
    public function __construct(array $numbers = [])
    {
        $this->numbers = $numbers;
    }

    public function add(int $number): void
    {
        $this->numbers[] = $number;
    }

    /**
     * @return int[]
     */
    public function toIntArray(): array
    {
        rsort($this->numbers);
        return $this->numbers;
    }
}