<?php declare(strict_types=1);
namespace Vaulverin\BracketValidator;

class BracketValidator
{
    const OPENING_BRACKET = '(';
    const CLOSING_BRACKET = ')';
    const INSIGNIFICANT_SYMBOLS = [' ', '\n', '\t', '\r'];

    /**
     * It takes string like "(()()()()))((((()()()))(()()()(((()))))))".
     * And returns true, if string is valid – all opening brackets are closed,
     * false otherwise.
     * @param string $strToParse
     * @return bool
     */
    public static function validate(string $strToParse) : bool
    {
        $bracketCounter = 0;
        $chars = str_split($strToParse);
        foreach ($chars as $char) {
            if (in_array($char, static::INSIGNIFICANT_SYMBOLS) === false) {
                if ($char === static::OPENING_BRACKET) {
                    $bracketCounter++;
                } else if ($char === static::CLOSING_BRACKET) {
                    $bracketCounter--;
                } else {
                    $errorMessage = 'Symbol "'. $char .'" is not acceptable.';
                    throw new \InvalidArgumentException($errorMessage);
                }
            }
            if ($bracketCounter < 0) {
                break;
            }
        }

        if ($bracketCounter == 0) {
            return true;
        }

        return false;
    }
}