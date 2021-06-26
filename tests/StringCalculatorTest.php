<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use Exception;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator();
    }

    /**
     * @test
     **/
    public function totalIsZeroIfEmptyText()
    {
        $this->assertEquals(0, $this->stringCalculator->add(""));
    }

    /**
     * @test
     **/
    public function totalIsNumberIfOneNumberText()
    {
        $this->assertEquals(1, $this->stringCalculator->add("1"));
    }

    /**
     * @test
     **/
    public function addsTwoNumbers()
    {
        $this->assertEquals(3, $this->stringCalculator->add("1,2"));
    }

    /**
     * @test
     **/
    public function addsMultipleNumbers()
    {
        $this->assertEquals(6, $this->stringCalculator->add("1,2,3"));
        $this->assertEquals(10, $this->stringCalculator->add("1,2,3,4"));
        $this->assertEquals(15, $this->stringCalculator->add("1,2,3,4,5"));
    }

    /**
     * @test
     **/
    public function usesBreakLinesAsDelimiter()
    {
        $this->assertEquals(6, $this->stringCalculator->add("1\n2,3"));
    }

    /**
     * @test
     **/
    public function changesDelimiter()
    {
        $this->assertEquals(3, $this->stringCalculator->add("//;\n1;2"));
        $this->assertEquals(10, $this->stringCalculator->add("//(\n1(2(3(4"));
        $this->assertEquals(15, $this->stringCalculator->add("//?\n1?2?3?4?5"));
    }

    /**
     * @test
     */
    public function checksNegativeNumbers()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Negativos no soportados: -5, -2, -4");

        $this->stringCalculator->add("//?\n1?-2?3?-4?-5");
    }

    /**
     * @test
     */
    public function ignoreNumbersGreaterThanOneThousand()
    {
        $this->assertEquals(2, $this->stringCalculator->add("2,1001"));
    }

    /**
     * @test
     */
    public function changesToLongDelimiter()
    {
        $this->assertEquals(6, $this->stringCalculator->add("//[delim]\n1delim2delim3"));
    }

    /**
     * @test
     */
    public function changesToShortDelimiter()
    {
        $this->assertEquals(6, $this->stringCalculator->add("//[]\n12***3"));
    }

    /**
     * @test
     */
    public function addsMultipleDelimiters()
    {
        $this->assertEquals(6, $this->stringCalculator->add("//[][%]\n12%3"));
        $this->assertEquals(6, $this->stringCalculator->add("//[*][.]\n1*2.3"));
    }
}