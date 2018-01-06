<?php

namespace Library;

use PHPUnit\Framework\TestCase;

class ParenthesisCheckerTest extends TestCase
{
    /**
     * @var ParenthesisChecker
     */
    private $checker;

    public function setUp()
    {
        $this->checker = new ParenthesisChecker();
    }

    public function testIsValidInputStringIsValidReturnTrue()
    {
        $this->assertTrue($this->checker->isValid("() \n\r\t"));
    }

    public function testIsValidInputStringIsInvalidReturnFalse()
    {
        $this->assertFalse($this->checker->isValid("abcdef"));
    }

    public function testCheckInvalidStringGotException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->checker->check("abcdef");
    }

    public function testCheckValidStringWithUnpairedParenthesisReturnFalse()
    {
        $this->assertFalse($this->checker->check("(()("));
    }

    public function testCheckValidStringWithPairedParenthesisReturnTrue()
    {
        $this->assertTrue($this->checker->check("(()())"));
    }
}