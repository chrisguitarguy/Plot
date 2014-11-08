<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

/**
 * Represents some form of textual input.
 *
 * @since   0.1
 */
class Input
{
    /**
     * The input filename.
     *
     * @var     string|null;
     */
    private $inputFile;

    /**
     * The input string
     *
     * @var     string
     */
    private $inputString;

    /**
     * The length of the input string.
     *
     * @var     int
     */
    private $inputLength;

    /**
     * The current position in the input string. This is used to fetch the current
     * character from the input and such.
     *
     * @var     int
     */
    private $position = 0;

    /**
     * The current start position in the input string. This is used when a call
     * to `slice` is made.
     *
     * @var     int
     */
    private $startPosition = 0;

    /**
     * The current line number.
     *
     * @var     int
     */
    private $lineno = 1;

    /**
     * Create a new instance from a file (and its contents)
     *
     * @param   string $filename The file to read
     * @return  Input
     */
    public static function fromFile($filename)
    {
        $input = file_get_contents($filename);
        return new static($filename, $input);
    }

    /**
     * Create a  new instance from a string.
     *
     * @param   string $input The input string
     * @return  Input
     */
    public static function fromString($input)
    {
        return new static(null, $input);
    }

    /**
     * Get the current character from the input
     *
     * @return  string
     */
    public function current()
    {
        if ($this->position >= $this->inputLength) {
            return null;
        }

        return mb_substr($this->inputString, $this->position, 1);
    }

    /**
     * Get the current character and advance the position to the next
     *
     * @return  string|null Null if we'rd passed the end of the string.
     */
    public function next()
    {
        $char = $this->current();
        if (null === $char) {
            return $char;
        }

        if ("\n" === $char) {
            $this->lineno++;
        }

        $this->position++;

        return $char;
    }

    /**
     * Back the position up a character.
     *
     * @return  void
     */
    public function backup()
    {
        if ($this->position < 1) {
            return;
        }
        $this->position--;
    }

    /**
     * Peek ahead at the next character
     *
     * @return  string
     */
    public function peek()
    {
        return mb_substr($this->inputString, $this->position+1, 1) ?: null;
    }

    /**
     * Look at the previous character in the input
     *
     * @return  string
     */
    public function lookbehind()
    {
        $idx = $this->position - 1;
        if ($idx < 0) {
            return null;
        }

        return mb_substr($this->inputString, $idx, 1);
    }

    /**
     * Pull the current string out and move the current start position.
     *
     * @return  string
     */
    public function slice()
    {
        $current = mb_substr($this->inputString, $this->startPosition, $this->position - $this->startPosition);
        $this->startPosition = $this->position;

        return $current;
    }

    /**
     * Ignore the current slice of the string defined by startPosition and position.
     *
     * This is like `slice` but doesn't return anything
     *
     * @return  void
     */
    public function ignore()
    {
        $this->startPosition = $this->position;
    }

    /**
     * Check to see if the current position onward starts with a given value
     *
     * @param   string $toCheck
     * @return  boolean
     */
    public function startsWith($toCheck)
    {
        return $this->position === mb_strpos($this->inputString, $toCheck, $this->position);
    }

    /**
     * Get the current context. The filename, linenumber and position. Useful
     * for errors.
     *
     * @return  string
     */
    public function context()
    {
        return sprintf(
            '%s:%s',
            null === $this->inputFile ? '-' : $this->inputFile,
            $this->lineno
        );
    }

    private function __construct($filename, $string)
    {
        $this->inputFile = $filename;
        $this->inputString = trim($string);
        $this->inputLength = mb_strlen($this->inputString);
        if (!$this->inputLength) {
            throw new \UnexpectedValueException('Zero length strings cannot be supplied to Input');
        }
    }
}
