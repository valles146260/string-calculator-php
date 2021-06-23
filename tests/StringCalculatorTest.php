<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    /**
     * @test
     **/
    public function returnZeroIfVoidStringIsPassed()
    {
        $stringCalculator = new StringCalculator();

        $this->assertEquals(0, $stringCalculator->add(""));
    }

    /**
     * @test
     **/
    public function returnNumberIfOneNumberStringIsPassed()
    {
        $stringCalculator = new StringCalculator();

        $this->assertEquals(1, $stringCalculator->add("1"));
    }

    /**
     * @test
     **/
    public function returnAddResultIfTwoNumbersStringIsPassed()
    {
        $stringCalculator = new StringCalculator();

        $this->assertEquals(3, $stringCalculator->add("1,2"));
    }
}