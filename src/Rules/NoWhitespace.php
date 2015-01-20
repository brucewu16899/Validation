<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Result;

/**
 * Validates if a string contains no whitespace (spaces, tabs and line breaks);
 */
class NoWhitespace implements RuleInterface
{
    /**
     * {@inheritDoc}
     */
    public function apply($input, Result $result)
    {
        $result->setValid((is_null($input) || is_string($input) && !preg_match('/\s/', $input)));
    }
}
