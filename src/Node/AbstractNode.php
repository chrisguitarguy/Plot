<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\Node;

use Chrisguitarguy\Plot\Token;

/**
 * ABC for nodes.
 *
 * @since   0.1
 */
abstract class AbstractNode implements Node
{
    /**
     * The token from which the node came.
     *
     * @var     Token
     */
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function context()
    {
        return $this->token->getContext();
    }
}
