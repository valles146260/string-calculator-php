<?php

namespace Deg540\StringCalculatorPHP;

interface NumbersRule
{
    public function checkNumbers(Numbers $numbers): Numbers;
}