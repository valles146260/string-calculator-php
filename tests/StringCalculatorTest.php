<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
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
     */
    public function givenEmptyStringReturnsZero()
    {
        $this->assertEquals(0, $this->stringCalculator->add(""));
    }

    /**
     * @test
     */
    public function givenTwoNumbersReturnsSum()
    {
        $this->assertEquals(3, $this->stringCalculator->add("1,2"));
    }

    /**
     * @test
     */
    public function givenOneNumberReturnsNumber()
    {
        #ANTES
        #$stringCalculator = new StringCalculator();

        #$result = $stringCalculator->add("1");

        #$this->assertEquals(1, $result);

        #DESPUES
        $this->assertEquals(1, $this->stringCalculator->add("1"));
    }

    /**
     * @test
     */
    /**
     * @test
     */
    public function givenMoreThanOneNumberReturnsSum()
    {
        $this->assertEquals(6, $this->stringCalculator->add("1,2,3"));
    }

    /**
     * @test
     */
    public function givenMoreThanOneNumberWithLineBreakReturnsSum()
    {
        $this->assertEquals(6, $this->stringCalculator->add("1\n2,3"));
    }


}