<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function givenEmptyStringReturnsZero()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("");

        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function givenTwoNumbersReturnsSum()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1,2");

        $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function givenOneNumberReturnsNumber()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1");

        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    /**
     * @test
     */
    public function givenMoreThanOneNumberReturnsSum()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1,2,3");

        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function givenMoreThanOneNumberWithLineBreakReturnsSum()
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add("1\n2,3");

        $this->assertEquals(6, $result);
    }


}