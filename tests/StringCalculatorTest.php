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

    /**
     * @test
     **/
    public function returnAddResultIfMultipleNumbersStringIsPassed()
    {
        $stringCalculator = new StringCalculator();

        $this->assertEquals(6, $stringCalculator->add("1,2,3"));
        $this->assertEquals(10, $stringCalculator->add("1,2,3,4"));
        $this->assertEquals(15, $stringCalculator->add("1,2,3,4,5"));
    }

    /**
     * @test
     **/
    public function returnAddResultIfNumbersStringWithBreakLinesIsPassed()
    {
        $stringCalculator = new StringCalculator();

        $this->assertEquals(6, $stringCalculator->add("1\n2,3"));
    }
}