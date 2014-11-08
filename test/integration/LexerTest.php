<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class LexerTest extends IntegrationTestCase
{
    private $lexer;

    public function testEmptyListProducesOpenAndCloseTokens()
    {
        $tokens = $this->lexer->tokenize(Input::fromString('( )'));
        $this->assertCount(3, $tokens);
    }

    public function testEmptyListInsideEmptyListProducesTwoPairsOfOpenAndCloseTokens()
    {
        $tokens = $this->lexer->tokenize(Input::fromString('( ( ) )'));
        $this->assertCount(5, $tokens);
    }

    public function strings()
    {
        return [
            ['"this is \\"a test"'],
            ["'this is \\'a test'"],
            ['""'],
            ["''"],
        ];
    }

    /**
     * @dataProvider strings
     */
    public function testListWithSingleStringParsesStringToken($string)
    {
        $tokens = $this->lexer->tokenize(Input::fromString("({$string})"));
        $this->assertCount(4, $tokens);
        $this->assertEquals($string, $tokens->at(1)->getValue());
        $this->assertEquals(Token::STRING_VALUE, $tokens->at(1)->getType());
    }

    public static function intValues()
    {
        return [
            ['123'],
            ['-123'],
            ['+123'],
            ['0x1AFa'],
            ['0X1AAA'],
        ];
    }

    /**
     * @dataProvider intValues
     */
    public function testListWithIntegerIsParsedIntoIntToken($intVal)
    {
        $in = Input::fromString("({$intVal})");
        $tokens = $this->lexer->tokenize($in);
        $this->assertCount(4, $tokens);
        $this->assertEquals($intVal, $tokens->at(1)->getValue());
        $this->assertEquals(Token::INT_VALUE, $tokens->at(1)->getType());
    }

    public static function floatValues()
    {
        return [
            ['123.0123'],
            ['+123.45'],
            ['-123.76'],
        ];
    }

    /**
     * @dataProvider floatValues
     */
    public function testListWithFloatIsParsedIntoIntToken($float)
    {
        $in = Input::fromString("({$float})");
        $tokens = $this->lexer->tokenize($in);
        $this->assertCount(4, $tokens);
        $this->assertEquals($float, $tokens->at(1)->getValue());
        $this->assertEquals(Token::FLOAT_VALUE, $tokens->at(1)->getType());
    }

    public static function idents()
    {
        return [
            ['+'],
            ['='],
            ['`'],
            ['`asdf'],
            ['asdf'],
            ['<'],
            ['>']
        ];
    }

    /**
     * @dataProvider idents
     */
    public function testListWithIdentifierIsParsedIntoIdentifierToken($ident)
    {
        $in = Input::fromString("({$ident})");
        $tokens = $this->lexer->tokenize($in);

        $this->assertCount(4, $tokens);
        $this->assertEquals($ident, $tokens->at(1)->getValue());
        $this->assertEquals(Token::IDENTIFIER, $tokens->at(1)->getType());
    }

    protected function setUp()
    {
        $this->lexer = new Lexer();
    }
}
