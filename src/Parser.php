<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class Parser
{
    /**
     * The underlying lexer
     *
     * @var     Lexer
     */
    private $lexer;

    public function __construct(Lexer $lexer=null)
    {
        $this->lexer = $lexer ?: new Lexer();
    }

    /**
     * Parse the program into a series of nodes.
     *
     * @param   $in The program
     * @return  Node[]
     */
    public function parse(Input $in)
    {
        $tokens = $this->lexer->tokenize($in);
        $nodes = array();
        while ($tokens->valid()) {
            $nodes[] = $this->doParse($tokens);
        }

        return new Program($nodes);
    }

    private function doParse(TokenStream $tokens)
    {
        $cur = $tokens->current();
        switch ($tokens->current()->getType()) {
            case Token::OPEN_LIST:
                return $this->parseList($tokens);
                break;
            case Token::STRING_VALUE:
            case Token::INT_VALUE:
            case Token::FLOAT_VALUE:
                return $this->parseValue($tokens);
                break;
            case Token::IDENTIFIER:
                return $this->parseIdentifier($tokens);
                break;
            case Token::EOF:
                $tokens->next();
                break;
            default:
                throw new Exception\ParseError('Unexpected token '.$cur);
        }
    }

    private function parseList(TokenStream $tokens)
    {
        $list = new Node\ListNode();
        $tokens->next();
        while ($tokens->valid() && !$tokens->current()->isType(Token::CLOSE_LIST)) {
            $list->add($this->doParse($tokens));
            $tokens->next();
        }
        $tokens->next();

        return $list;
    }

    private function parseValue(TokenStream $tokens)
    {
        $cur = $tokens->current();
        switch ($cur->getType()) {
            case Token::STRING_VALUE:
                $value = trim($cur->getValue(), '"\'');
                break;
            case Token::INT_VALUE:
                $value = intval($cur->getValue());
                break;
            case Token::FLOAT_VALUE:
                $value = floatval($cur->getValue());
                break;
        }
        $tokens->next();

        return new Node\ValueNode($value);
    }

    private function parseIdentifier(TokenStream $tokens)
    {
        $node = new Node\IdentifierNode($tokens->current()->getValue());
        $tokens->next();

        return $node;
    }
}
